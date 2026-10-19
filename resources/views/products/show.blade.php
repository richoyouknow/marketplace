@extends('layouts.app')

@section('title', $product['name'] . ' - ALLWEAR FASHION')

@section('content')
<div class="max-w-[1440px] mx-auto px-4 lg:px-8">
    
    <!-- Breadcrumbs -->
    <div class="py-4 flex items-center gap-2 text-sm text-gray-500 mb-4">
        <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <a href="{{ route('products.index') }}" class="hover:text-primary">Produk</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <span class="text-gray-900 font-medium truncate">{{ $product['name'] }}</span>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 lg:p-12 shadow-sm mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Gallery -->
            <div x-data="{ mainImage: '{{ $product['image'] }}' }" class="space-y-4">
                <!-- Main Image -->
                <div class="aspect-[4/3] bg-gray-50 rounded-xl overflow-hidden border border-gray-100 flex items-center justify-center">
                    <img :src="mainImage" alt="{{ $product['name'] }}" class="max-w-full max-h-full object-contain">
                </div>
                
                <!-- Thumbnails -->
                @if(count($product['gallery']) > 0)
                <div class="grid grid-cols-4 gap-4">
                    <button @click="mainImage = '{{ $product['image'] }}'" class="aspect-square bg-gray-50 rounded-lg overflow-hidden border-2 border-transparent focus:border-primary hover:border-primary/50 transition">
                        <img src="{{ $product['image'] }}" alt="Thumb" class="w-full h-full object-cover">
                    </button>
                    @foreach($product['gallery'] as $img)
                    <button @click="mainImage = '{{ $img }}'" class="aspect-square bg-gray-50 rounded-lg overflow-hidden border-2 border-transparent focus:border-primary hover:border-primary/50 transition">
                        <img src="{{ $img }}" alt="Thumb" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="flex flex-col">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-wider">{{ $product['brand'] }}</span>
                    @if(in_array('best seller', $product['tags']))
                    <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider">Terlaris</span>
                    @endif
                </div>
                
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight mb-4">{{ $product['name'] }}</h1>
                
                <div class="flex items-center gap-4 mb-6 text-sm">
                    <div class="flex items-center gap-1 text-yellow-500">
                        @for($i=1; $i<=5; $i++)
                            @if($i <= floor($product['rating']))
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            @elseif($i - 0.5 <= $product['rating'])
                                <i data-lucide="star-half" class="w-4 h-4 fill-current"></i>
                            @else
                                <i data-lucide="star" class="w-4 h-4 text-gray-300"></i>
                            @endif
                        @endfor
                        <span class="text-gray-900 font-bold ml-1">{{ number_format($product['rating'], 1) }}</span>
                    </div>
                    <a href="#reviews" class="text-primary hover:underline">{{ $product['review_count'] }} Ulasan</a>
                    <span class="text-gray-300">|</span>
                    <span class="text-gray-500">{{ $product['sold_count'] }} Terjual</span>
                </div>
                
                <div x-data="{
                    hasVariants: {{ !empty($product['variants']) ? 'true' : 'false' }},
                    variants: {{ Js::from($product['variants'] ?? []) }},
                    basePrice: {{ (int) $product['price'] }},
                    selectedVariant: null,
                    selectedSize: '',
                    selectedVariantId: '',
                    selectedStock: {{ (int) $product['stock'] }},
                    additionalPrice: 0,
                    qty: 1,
                    showValidationAlert: false,
                    
                    selectSize(v) {
                        if (!v || v.stock <= 0) return;
                        this.selectedVariant = v;
                        this.selectedVariantId = v.id;
                        this.selectedSize = v.size;
                        this.selectedStock = v.stock;
                        this.additionalPrice = v.additional_price || 0;
                        this.showValidationAlert = false;
                        if (this.qty > v.stock) {
                            this.qty = Math.max(1, v.stock);
                        }
                    },
                    
                    get currentPrice() {
                        return this.basePrice + (this.selectedVariant ? (this.selectedVariant.additional_price || 0) : 0);
                    },
                    
                    handleSubmit(isBuyNow = false) {
                        if (this.hasVariants && !this.selectedSize) {
                            this.showValidationAlert = true;
                            document.getElementById('sizeSelectionArea')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            return;
                        }
                        
                        if (isBuyNow) {
                            document.getElementById('buyNowForm').submit();
                        } else {
                            document.getElementById('addToCartForm').submit();
                        }
                    }
                }" class="flex flex-col flex-1">
                    
                    <!-- Price Box -->
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 mb-8">
                        <div class="flex flex-wrap items-baseline gap-3 mb-2">
                            <span class="text-3xl md:text-4xl font-bold text-gray-900" x-text="'Rp ' + currentPrice.toLocaleString('id-ID')">
                                Rp {{ number_format($product['price'], 0, ",", ".") }}
                            </span>
                            <template x-if="additionalPrice > 0">
                                <span class="text-xs font-bold text-orange-700 bg-orange-100 border border-orange-200 px-2.5 py-1 rounded-full">
                                    +Rp <span x-text="additionalPrice.toLocaleString('id-ID')"></span> (Ukuran <span x-text="selectedSize"></span>)
                                </span>
                            </template>
                            @if($product['discount_percentage'] > 0)
                            <span class="text-lg text-gray-400 line-through">Rp {{ number_format($product['original_price'], 0, ",", ".") }}</span>
                            <span class="text-sm font-bold text-red-500">{{ $product['discount_percentage'] }}% DISKON</span>
                            @endif
                        </div>
                        <div class="text-sm text-gray-500 flex items-center gap-2">
                            <i data-lucide="truck" class="w-4 h-4 text-primary"></i> Gratis ongkir untuk pesanan di atas Rp 500.000
                        </div>
                    </div>

                    <!-- Pilihan Ukuran Produk (Kondisional: Hanya tampil jika produk punya varian) -->
                    @if(!empty($product['variants']))
                    <div id="sizeSelectionArea" class="mb-8 p-5 rounded-2xl border transition-all duration-200"
                         :class="showValidationAlert ? 'bg-red-50/60 border-red-300 ring-2 ring-red-200' : 'bg-gray-50/50 border-gray-200'">
                        
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <label class="text-sm font-bold text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                                    <i data-lucide="ruler" class="w-4 h-4 text-primary"></i>
                                    Pilih Ukuran:
                                </label>
                                <template x-if="selectedSize">
                                    <span class="text-xs font-bold px-2 py-0.5 rounded bg-primary/10 text-primary border border-primary/20">
                                        Terpilih: <strong x-text="selectedSize"></strong>
                                    </span>
                                </template>
                                <template x-if="!selectedSize">
                                    <span class="text-xs text-red-500 font-medium">
                                        *Wajib memilih ukuran
                                    </span>
                                </template>
                            </div>
                            <span class="text-xs text-gray-500" x-show="selectedVariant">
                                Sisa stok ukuran ini: <strong class="text-gray-900 font-bold" x-text="selectedStock"></strong> buah
                            </span>
                        </div>

                        <!-- Alert Validasi Jika Belum Memilih Ukuran -->
                        <div x-show="showValidationAlert" x-transition class="mb-4 p-3 bg-red-100 border border-red-200 rounded-xl flex items-center gap-2 text-xs font-bold text-red-700">
                            <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                            <span>Silakan pilih salah satu ukuran produk di bawah ini sebelum melanjutkan!</span>
                        </div>

                        <!-- Interactive Variant Buttons -->
                        <div class="flex flex-wrap items-center gap-3">
                            @foreach($product['variants'] as $v)
                            @php
                                $isAvailable = $v['stock'] > 0 && ($v['is_active'] ?? true);
                            @endphp
                            <button type="button"
                                    @if($isAvailable)
                                    @click="selectSize({{ Js::from($v) }})"
                                    :class="selectedVariantId === {{ $v['id'] }} 
                                        ? 'border-primary bg-primary text-white shadow-md shadow-orange-500/30 scale-105' 
                                        : 'border-gray-300 bg-white text-gray-800 hover:border-primary hover:text-primary'"
                                    @else
                                    disabled
                                    class="border-gray-200 bg-gray-100 text-gray-400 cursor-not-allowed opacity-60 line-through"
                                    @endif
                                    class="min-w-[52px] h-13 px-4 rounded-xl border-2 font-bold text-sm flex flex-col items-center justify-center transition-all duration-150 relative group">
                                
                                <span class="text-base">{{ $v['size'] }}</span>
                                
                                @if(!$isAvailable)
                                <span class="text-[9px] font-bold text-red-500 no-underline block leading-tight">Habis</span>
                                @elseif($v['additional_price'] > 0)
                                <span class="text-[9px] block leading-tight font-medium" :class="selectedVariantId === {{ $v['id'] }} ? 'text-white' : 'text-orange-600'">
                                    +{{ number_format($v['additional_price'] / 1000, 0) }}k
                                </span>
                                @endif
                            </button>
                            @endforeach
                        </div>

                        <!-- Status Keterangan Ukuran -->
                        <div class="mt-3.5 flex flex-wrap items-center gap-4 text-xs text-gray-400 border-t border-gray-200/60 pt-3">
                            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-white border-2 border-primary"></span> Dapat Dipilih</span>
                            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-gray-300"></span> Habis / Tidak Tersedia</span>
                        </div>
                    </div>
                    @endif

                    <!-- Detail Ketersediaan & Info Singkat -->
                    <div class="grid grid-cols-2 gap-4 mb-8 text-sm">
                        <div>
                            <span class="text-gray-500 block mb-1">Availability</span>
                            <template x-if="hasVariants && selectedVariant">
                                <span class="font-medium flex items-center gap-1" :class="selectedStock > 0 ? 'text-green-600' : 'text-red-600'">
                                    <i data-lucide="check-circle-2" class="w-4 h-4" x-show="selectedStock > 0"></i>
                                    <i data-lucide="x-circle" class="w-4 h-4" x-show="selectedStock <= 0"></i>
                                    <span x-text="selectedStock > 0 ? 'Tersedia (' + selectedStock + ' untuk ' + selectedSize + ')' : 'Ukuran ' + selectedSize + ' Habis'"></span>
                                </span>
                            </template>
                            <template x-if="!hasVariants || !selectedVariant">
                                <span class="font-medium text-green-600 flex items-center gap-1">
                                    <i data-lucide="check-circle-2" class="w-4 h-4"></i> Tersedia ({{ $product['stock'] }} buah)
                                </span>
                            </template>
                        </div>
                        <div>
                            <span class="text-gray-500 block mb-1">Condition</span>
                            <span class="font-medium text-gray-900">{{ $product['condition'] }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block mb-1">Pesanan Minimum</span>
                            <span class="font-medium text-gray-900">{{ $product['min_order'] }} buah</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block mb-1">Supplier</span>
                            <span class="font-medium text-gray-900">{{ $product['supplier'] }}</span>
                        </div>
                    </div>

                    <!-- Lokasi Toko -->
                    <div class="rounded-xl border border-orange-100 bg-orange-50/70 p-4 mb-8">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-full bg-white text-primary flex items-center justify-center shrink-0 shadow-sm">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-wider text-primary mb-1">Barang terdekat dari lokasi</p>
                                <p class="text-sm font-medium text-gray-900 leading-relaxed">{{ $product['address'] }}</p>
                                <a href="{{ $product['map_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 mt-2 text-sm font-bold text-primary hover:underline">
                                    Buka alamat asli di Google Maps <i data-lucide="external-link" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="border-gray-200 mb-8">

                    <!-- Actions & Quantity -->
                    <div class="mt-auto space-y-4">
                        <div class="flex items-center gap-4 mb-6">
                            <span class="text-gray-900 font-medium">Jumlah:</span>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-32">
                                <button type="button" @click="if(qty > 1) qty--" class="w-10 h-10 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 transition font-bold">-</button>
                                <input type="number" x-model.number="qty" min="1" :max="selectedStock" class="w-full h-10 text-center font-bold text-gray-900 border-x border-gray-300 focus:outline-none appearance-none m-0 p-0">
                                <button type="button" @click="if(qty < selectedStock) qty++" class="w-10 h-10 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 transition font-bold">+</button>
                            </div>
                            <span class="text-sm text-gray-500">
                                <span class="font-bold text-gray-900" x-text="selectedStock"></span> buah tersedia
                            </span>
                        </div>

                        <!-- Form Tambah ke Keranjang -->
                        <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST" @submit.prevent="handleSubmit(false)">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <input type="hidden" name="quantity" :value="qty">
                            <input type="hidden" name="size" :value="selectedSize">
                            <input type="hidden" name="variant_id" :value="selectedVariantId">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 transition-colors shadow-lg shadow-orange-500/30">
                                    <i data-lucide="shopping-cart" class="w-5 h-5"></i> Tambah ke Keranjang
                                </button>
                                <button type="button" @click="handleSubmit(true)" class="w-full bg-gray-900 hover:bg-black text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 transition-colors shadow-lg shadow-gray-900/20">
                                    Buy Now
                                </button>
                            </div>
                        </form>
                        
                        <!-- Form Buy Now (redirect to checkout) -->
                        <form id="buyNowForm" action="{{ route('cart.add') }}" method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <input type="hidden" name="quantity" :value="qty">
                            <input type="hidden" name="size" :value="selectedSize">
                            <input type="hidden" name="variant_id" :value="selectedVariantId">
                            <input type="hidden" name="redirect" value="checkout">
                        </form>
                        
                        <div class="mt-6 flex items-center justify-center">
                            <button type="button" class="flex items-center gap-2 text-gray-500 hover:text-red-500 font-medium transition">
                                <i data-lucide="heart" class="w-5 h-5"></i> Add to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
    <!-- Specs and Description -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Deskripsi Produk</h3>
                <div class="prose max-w-none text-gray-600 space-y-4">
                    <p class="leading-relaxed text-base">{{ $product['description'] }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm not-prose">
                        <div class="flex items-start gap-3 p-3 bg-orange-50/50 rounded-xl border border-orange-100">
                            <i data-lucide="zap" class="w-5 h-5 text-primary shrink-0 mt-0.5"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">Status: Siap Dikirim</h4>
                                <p class="text-xs text-gray-500 mt-0.5">Produk ready stock dan diproses kirim maksimal 1x24 jam kerja dari alamat toko.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-green-50/50 rounded-xl border border-green-100">
                            <i data-lucide="shield-check" class="w-5 h-5 text-green-600 shrink-0 mt-0.5"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">Garansi Kualitas 100%</h4>
                                <p class="text-xs text-gray-500 mt-0.5">Quality check ganda sebelum packing untuk memastikan kondisi barang sempurna.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Spesifikasi</h3>
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($product['specifications'] as $key => $value)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 bg-gray-50 w-1/3">{{ $key }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $value }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm sticky top-24">
                <h3 class="font-bold text-gray-900 mb-6">Produk Terkait</h3>
                <div class="space-y-4">
                    @foreach($relatedProducts as $related)
                    <a href="{{ route('products.show', $related['slug']) }}" class="flex gap-4 group">
                        <div class="w-20 h-20 bg-gray-50 rounded-lg border border-gray-100 overflow-hidden shrink-0">
                            <img src="{{ $related['image'] }}" alt="{{ $related['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4 class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-primary transition-colors mb-1">{{ $related['name'] }}</h4>
                            <span class="font-bold text-gray-900">Rp {{ number_format($related['price'], 0, ",", ".") }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


