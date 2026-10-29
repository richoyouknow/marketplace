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
                    <span class="inline-flex items-center gap-1 text-xs font-bold text-primary bg-primary/10 px-2.5 py-1 rounded-full uppercase tracking-wider">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> ALLWEAR Official
                    </span>
                    @if(in_array('best seller', $product['tags']))
                    <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider">Terlaris</span>
                    @endif
                    @if(in_array('new', $product['tags']))
                    <span class="bg-blue-100 text-blue-600 text-[10px] font-bold px-2 py-0.5 rounded-sm uppercase tracking-wider">Baru</span>
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
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-gray-500" x-show="selectedVariant">
                                    Sisa stok: <strong class="text-gray-900 font-bold" x-text="selectedStock"></strong> buah
                                </span>
                                @if(!empty($product['size_chart']))
                                <button type="button" @click="document.dispatchEvent(new CustomEvent('switch-tab', { detail: 'size_chart' })); document.getElementById('product-specs-section')?.scrollIntoView({ behavior: 'smooth' });" class="text-xs font-semibold text-primary hover:text-orange-600 transition flex items-center gap-1 underline underline-offset-2">
                                    <i data-lucide="ruler" class="w-3.5 h-3.5"></i>
                                    Panduan Ukuran
                                </button>
                                @endif
                            </div>
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
                            <span class="text-gray-500 block mb-1">Kategori</span>
                            <span class="font-medium text-gray-900 capitalize">{{ $product['category'] }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500 block mb-1">Brand Resmi</span>
                            <span class="font-semibold text-primary flex items-center gap-1">
                                <i data-lucide="badge-check" class="w-4 h-4 text-primary"></i> ALLWEAR Official
                            </span>
                        </div>
                    </div>

                    <!-- Layanan Pengiriman Resmi Allwear -->
                    <div class="rounded-xl border border-orange-100 bg-orange-50/70 p-4 mb-8">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-full bg-white text-primary flex items-center justify-center shrink-0 shadow-sm">
                                <i data-lucide="package-check" class="w-5 h-5"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold uppercase tracking-wider text-primary mb-1">Koleksi Eksklusif ALLWEAR</p>
                                <p class="text-sm font-medium text-gray-900 leading-relaxed">Produk resmi brand ALLWEAR dengan standar jahitan dan bahan terkurasi. Dikemas rapi dan dikirim langsung ke seluruh Indonesia.</p>
                                <div class="flex flex-wrap items-center gap-3 mt-2 text-xs font-medium text-gray-600">
                                    <span class="inline-flex items-center gap-1"><i data-lucide="check" class="w-3.5 h-3.5 text-green-600"></i> 100% Original ALLWEAR</span>
                                    <span class="inline-flex items-center gap-1"><i data-lucide="truck" class="w-3.5 h-3.5 text-primary"></i> Pengiriman Bergaransi</span>
                                </div>
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
    <div id="product-specs-section" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8" x-data="{ activeTab: 'description' }" x-on:switch-tab.window="activeTab = $event.detail">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                <!-- Navigation Tabs -->
                <div class="flex border-b border-gray-200 bg-gray-50/80 overflow-x-auto no-scrollbar">
                    <button type="button" 
                            @click="activeTab = 'description'"
                            :class="activeTab === 'description' ? 'border-primary text-primary bg-white font-bold shadow-xs' : 'border-transparent text-gray-500 hover:text-gray-900 font-medium'"
                            class="py-4 px-6 border-b-2 text-sm whitespace-nowrap transition-colors flex items-center gap-2">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                        Deskripsi &amp; Detail
                    </button>
                    @if(!empty($product['size_chart']))
                    <button type="button" 
                            @click="activeTab = 'size_chart'"
                            :class="activeTab === 'size_chart' ? 'border-primary text-primary bg-white font-bold shadow-xs' : 'border-transparent text-gray-500 hover:text-gray-900 font-medium'"
                            class="py-4 px-6 border-b-2 text-sm whitespace-nowrap transition-colors flex items-center gap-2">
                        <i data-lucide="ruler" class="w-4 h-4"></i>
                        Panduan Ukuran (Size Chart)
                        <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-orange-100 text-orange-700">
                            {{ $product['category'] }}
                        </span>
                    </button>
                    @endif
                    <button type="button" 
                            @click="activeTab = 'material_care'"
                            :class="activeTab === 'material_care' ? 'border-primary text-primary bg-white font-bold shadow-xs' : 'border-transparent text-gray-500 hover:text-gray-900 font-medium'"
                            class="py-4 px-6 border-b-2 text-sm whitespace-nowrap transition-colors flex items-center gap-2">
                        <i data-lucide="sparkles" class="w-4 h-4"></i>
                        Material &amp; Perawatan
                    </button>
                    <button type="button" 
                            @click="activeTab = 'specs'"
                            :class="activeTab === 'specs' ? 'border-primary text-primary bg-white font-bold shadow-xs' : 'border-transparent text-gray-500 hover:text-gray-900 font-medium'"
                            class="py-4 px-6 border-b-2 text-sm whitespace-nowrap transition-colors flex items-center gap-2">
                        <i data-lucide="list-checks" class="w-4 h-4"></i>
                        Spesifikasi Lengkap
                    </button>
                </div>

                <div class="p-6 md:p-8">
                    <!-- TAB 1: DESKRIPSI & DETAIL -->
                    <div x-show="activeTab === 'description'" class="space-y-8" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900 tracking-tight flex items-center gap-2">
                                    <span class="w-2 h-5 bg-primary rounded-full"></span>
                                    Deskripsi Produk
                                </h3>
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">ALLWEAR Official Collection</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed text-base">
                                {{ $product['description'] }}
                            </p>
                        </div>

                        <!-- Product Quick Highlights (Material & Color) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @if(!empty($product['material']))
                            <div class="flex items-center gap-3.5 p-4 rounded-xl border border-gray-200/80 bg-gray-50/50">
                                <div class="w-10 h-10 rounded-lg bg-orange-100 text-primary flex items-center justify-center shrink-0">
                                    <i data-lucide="layers" class="w-5 h-5"></i>
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 block">Material Bahan</span>
                                    <span class="font-bold text-gray-900 text-sm truncate block">{{ $product['material'] }}</span>
                                </div>
                            </div>
                            @endif

                            @if(!empty($product['color']))
                            <div class="flex items-center gap-3.5 p-4 rounded-xl border border-gray-200/80 bg-gray-50/50">
                                <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                                    <i data-lucide="palette" class="w-5 h-5"></i>
                                </div>
                                <div class="min-w-0">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 block">Varian Warna</span>
                                    <span class="font-bold text-gray-900 text-sm truncate block">{{ $product['color'] }}</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Product Details / Detail Desain & Konstruksi -->
                        @if(!empty($product['structured_details']))
                        <div class="pt-2">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-4 flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4 text-primary"></i>
                                Detail Desain & Karakteristik
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                                @foreach($product['structured_details'] as $label => $val)
                                <div class="flex items-start gap-3 p-3.5 rounded-xl border border-gray-100 bg-white hover:border-gray-200 transition shadow-2xs">
                                    <span class="w-2 h-2 rounded-full bg-primary mt-1.5 shrink-0"></span>
                                    <div class="text-sm">
                                        <span class="font-semibold text-gray-800 block">{{ $label }}</span>
                                        <span class="text-gray-600 mt-0.5 block leading-normal">{{ $val }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Model Information (Only displayed if verified data exists) -->
                        @if(!empty($product['model_info']))
                        <div class="p-4 rounded-xl border border-blue-100 bg-blue-50/60 flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center shrink-0">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-blue-900">Informasi Model</h4>
                                <p class="text-xs text-blue-800 mt-0.5 leading-relaxed">{{ $product['model_info'] }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Additional Notes & Official Assurances -->
                        <div class="pt-4 border-t border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="flex items-start gap-3 p-4 bg-orange-50/60 rounded-xl border border-orange-100">
                                <i data-lucide="zap" class="w-5 h-5 text-primary shrink-0 mt-0.5"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Status: Siap Dikirim</h4>
                                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">Produk ready stock dan diproses kirim maksimal 1x24 jam kerja langsung oleh tim ALLWEAR.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-4 bg-green-50/60 rounded-xl border border-green-100">
                                <i data-lucide="shield-check" class="w-5 h-5 text-green-600 shrink-0 mt-0.5"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Garansi Kualitas 100%</h4>
                                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">Quality control ganda sebelum packing untuk memastikan kerapian jahitan dan keaslian produk.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: PANDUAN UKURAN (SIZE CHART) -->
                    @if(!empty($product['size_chart']))
                    <div x-show="activeTab === 'size_chart'" id="size-chart" class="space-y-6" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-2 h-5 bg-primary rounded-full"></span>
                                    {{ $product['size_chart']['title'] }}
                                </h3>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-gray-100 text-gray-600">
                                    Satuan: Sentimeter (cm)
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                @if(!empty($product['size_chart']['notes']))
                                    {{ $product['size_chart']['notes'] }}
                                @else
                                    Tabel ukuran ini disesuaikan khusus untuk kategori {{ $product['category'] }} dan hanya menampilkan varian ukuran yang tersedia untuk produk ini.
                                @endif
                            </p>
                        </div>

                        <!-- Size Chart Table -->
                        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-2xs">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead>
                                    <tr class="bg-gray-50">
                                        @foreach($product['size_chart']['headers'] as $index => $header)
                                        <th scope="col" class="py-3.5 px-4 text-xs font-bold text-gray-700 uppercase tracking-wider {{ $index === 0 ? 'text-left bg-gray-100/70' : 'text-center' }}">
                                            {{ $header }}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($product['size_chart']['rows'] as $row)
                                    <tr class="transition-colors hover:bg-orange-50/40"
                                        :class="selectedSize && selectedSize.toUpperCase() === '{{ strtoupper($row['size']) }}' ? 'bg-orange-50 font-bold' : ''">
                                        <td class="whitespace-nowrap py-3.5 px-4 font-bold text-gray-900 bg-gray-50/40 text-left border-r border-gray-100">
                                            <div class="flex items-center gap-2">
                                                <span>{{ $row['size'] }}</span>
                                                <template x-if="selectedSize && selectedSize.toUpperCase() === '{{ strtoupper($row['size']) }}'">
                                                    <span class="text-[10px] font-bold text-primary bg-primary/10 px-1.5 py-0.5 rounded">Pilihan Anda</span>
                                                </template>
                                            </div>
                                        </td>
                                        @foreach($row['values'] as $val)
                                        <td class="whitespace-nowrap py-3.5 px-4 text-gray-600 text-center font-medium">
                                            {{ $val }}
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Measuring Guide Callout -->
                        @if(!empty($product['size_chart']['guide']))
                        <div class="p-4 rounded-xl border border-amber-200/80 bg-amber-50/60 flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                                <i data-lucide="help-circle" class="w-5 h-5"></i>
                            </div>
                            <div class="text-xs text-amber-900">
                                <span class="font-bold block text-sm mb-1">Panduan Pengukuran</span>
                                <p class="leading-relaxed">{{ $product['size_chart']['guide'] }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Size Tolerance & Exchange Note -->
                        <div class="p-4 rounded-xl border border-gray-200 bg-gray-50/60 flex items-start gap-3 text-xs text-gray-600">
                            <i data-lucide="info" class="w-4 h-4 text-primary shrink-0 mt-0.5"></i>
                            <div class="space-y-1">
                                <p><strong>Catatan Toleransi:</strong> Selisih 1-2 cm dapat terjadi karena proses pemotongan dan penjahitan manual pada produksi massal.</p>
                                <p><strong>Ragu dengan ukuran?</strong> ALLWEAR memberikan garansi penukaran ukuran maksimal 3 hari kerja setelah produk diterima.</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- TAB 3: MATERIAL & PERAWATAN -->
                    <div x-show="activeTab === 'material_care'" class="space-y-6" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                <span class="w-2 h-5 bg-primary rounded-full"></span>
                                Material & Karakteristik Bahan
                            </h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                ALLWEAR memilih material secara teliti untuk memastikan kenyamanan bernapas, keawetan warna, dan kelembutan pada kulit Anda.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl border border-gray-200 bg-gray-50/50">
                                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-1">Material Utama</span>
                                <span class="text-base font-bold text-gray-900 block">{{ $product['material'] ?? 'Kain Pilihan Berkualitas Tinggi' }}</span>
                                <p class="text-xs text-gray-500 mt-1">Ditenun dengan standar kerapatan serat optimal untuk ketahanan bentuk jangka panjang.</p>
                            </div>

                            <div class="p-4 rounded-xl border border-gray-200 bg-gray-50/50">
                                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-1">Karakteristik Warna</span>
                                <span class="text-base font-bold text-gray-900 block">{{ $product['color'] ?? 'Warna Eksklusif ALLWEAR' }}</span>
                                <p class="text-xs text-gray-500 mt-1">Menggunakan pewarna ramah lingkungan dengan ketahanan luntur tinggi.</p>
                            </div>
                        </div>

                        <!-- Care Guidelines -->
                        <div>
                            <h4 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-4 flex items-center gap-2">
                                <i data-lucide="shield-check" class="w-4 h-4 text-green-600"></i>
                                Petunjuk Perawatan (Garment Care Guide)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                                @foreach($product['care_instructions'] as $instruction)
                                <div class="flex items-start gap-3 p-3.5 rounded-xl border border-gray-200/70 bg-white">
                                    <div class="w-6 h-6 rounded-full bg-orange-100 text-primary flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-xs text-gray-700 leading-relaxed font-medium">{{ $instruction }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Quality Assurance -->
                        <div class="p-4 rounded-xl border border-green-100 bg-green-50/60 flex items-start gap-3 text-xs text-green-900">
                            <i data-lucide="award" class="w-5 h-5 text-green-600 shrink-0"></i>
                            <div>
                                <span class="font-bold block text-sm mb-0.5">Jaminan Standar ALLWEAR Official</span>
                                <p class="leading-relaxed">Setiap produk lolos uji kendali mutu sebelum dikemas. Perawatan yang sesuai akan menjaga kelembutan dan kualitas kain hingga bertahun-tahun.</p>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: SPESIFIKASI LENGKAP -->
                    <div x-show="activeTab === 'specs'" class="space-y-6" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 flex items-center gap-2">
                                <span class="w-2 h-5 bg-primary rounded-full"></span>
                                Spesifikasi Teknis Produk
                            </h3>
                            <p class="text-sm text-gray-500">Daftar lengkap atribut teknis resmi dari basis data ALLWEAR.</p>
                        </div>

                        <div class="overflow-hidden rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr>
                                        <td class="py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 bg-gray-50 w-1/3">Brand</td>
                                        <td class="px-3 py-3.5 text-sm font-bold text-primary flex items-center gap-1.5">
                                            <i data-lucide="badge-check" class="w-4 h-4 text-primary"></i>
                                            ALLWEAR Official
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 bg-gray-50 w-1/3">Kategori Produk</td>
                                        <td class="px-3 py-3.5 text-sm text-gray-700 capitalize font-medium">{{ $product['category'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 bg-gray-50 w-1/3">Kondisi</td>
                                        <td class="px-3 py-3.5 text-sm text-gray-700 font-medium">{{ $product['condition'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 bg-gray-50 w-1/3">Ketersediaan</td>
                                        <td class="px-3 py-3.5 text-sm text-green-600 font-semibold flex items-center gap-1">
                                            <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                                            {{ $product['availability'] }}
                                        </td>
                                    </tr>
                                    @foreach($product['specifications'] as $key => $value)
                                    @if(strtolower($key) !== 'brand')
                                    <tr>
                                        <td class="py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 bg-gray-50 w-1/3">{{ $key }}</td>
                                        <td class="px-3 py-3.5 text-sm text-gray-600 font-medium">{{ $value }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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


