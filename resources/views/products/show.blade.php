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
                
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 mb-8">
                    <div class="flex items-end gap-3 mb-2">
                        <span class="text-3xl md:text-4xl font-bold text-gray-900">Rp {{ number_format($product['price'], 0, ",", ".") }}</span>
                        @if($product['discount_percentage'] > 0)
                        <span class="text-lg text-gray-400 line-through mb-1">Rp {{ number_format($product['original_price'], 0, ",", ".") }}</span>
                        <span class="text-sm font-bold text-red-500 mb-1.5">{{ $product['discount_percentage'] }}% DISKON</span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-500 flex items-center gap-2">
                        <i data-lucide="truck" class="w-4 h-4"></i> Gratis ongkir untuk pesanan di atas Rp 500.000
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-8 text-sm">
                    <div>
                        <span class="text-gray-500 block mb-1">Availability</span>
                        <span class="font-medium text-green-600 flex items-center gap-1"><i data-lucide="check-circle-2" class="w-4 h-4"></i> Tersedia ({{ $product['stock'] }})</span>
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

                <!-- Actions -->
                <form action="{{ route('cart.add') }}" method="POST" class="mt-auto space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-gray-900 font-medium">Jumlah:</span>
                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-32" x-data="{ qty: 1, max: {{ $product['stock'] }} }">
                            <button type="button" @click="if(qty > 1) qty--" class="w-10 h-10 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 transition">-</button>
                            <input type="number" name="quantity" x-model="qty" min="1" :max="max" class="w-full h-10 text-center font-bold text-gray-900 border-x border-gray-300 focus:outline-none appearance-none m-0 p-0">
                            <button type="button" @click="if(qty < max) qty++" class="w-10 h-10 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 transition">+</button>
                        </div>
                        <span class="text-sm text-gray-400">{{ $product['stock'] }} buah tersedia</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 transition-colors shadow-lg shadow-orange-500/30">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i> Tambah ke Keranjang
                        </button>
                        <a href="{{ route('checkout.index') }}" onclick="event.preventDefault(); document.getElementById('buy-now-form').submit();" class="w-full bg-gray-900 hover:bg-black text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 transition-colors shadow-lg shadow-gray-900/20">
                            Buy Now
                        </a>
                    </div>
                </form>
                
                <form id="buy-now-form" action="{{ route('cart.add') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="redirect" value="checkout">
                </form>
                
                <div class="mt-6 flex items-center justify-center">
                    <button class="flex items-center gap-2 text-gray-500 hover:text-red-500 font-medium transition">
                        <i data-lucide="heart" class="w-5 h-5"></i> Add to Wishlist
                    </button>
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


