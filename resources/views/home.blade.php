@extends('layouts.app')

@section('content')
<div class="content-shell space-y-12">

    <!-- Hero Section -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar Categories (Desktop) -->
        <div class="hidden lg:block bg-white rounded-xl border border-gray-200 p-4">
            <h3 class="font-bold text-gray-900 mb-4 px-2">Top Categories</h3>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('products.index', ['category' => 'kemeja']) }}" class="flex items-center justify-between px-3 py-2 text-sm text-gray-600 hover:bg-orange-50 hover:text-primary rounded-lg transition-colors">
                        <span class="flex items-center gap-3"><i data-lucide="shirt" class="w-4 h-4 text-gray-400"></i> Kemeja</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index', ['category' => 'dress']) }}" class="flex items-center justify-between px-3 py-2 text-sm text-gray-600 hover:bg-orange-50 hover:text-primary rounded-lg transition-colors">
                        <span class="flex items-center gap-3"><i data-lucide="shirt" class="w-4 h-4 text-gray-400"></i> Dress</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index', ['category' => 'kaos']) }}" class="flex items-center justify-between px-3 py-2 text-sm text-gray-600 hover:bg-orange-50 hover:text-primary rounded-lg transition-colors">
                        <span class="flex items-center gap-3"><i data-lucide="shirt" class="w-4 h-4 text-gray-400"></i> Kaos</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index', ['category' => 'celana']) }}" class="flex items-center justify-between px-3 py-2 text-sm text-gray-600 hover:bg-orange-50 hover:text-primary rounded-lg transition-colors">
                        <span class="flex items-center gap-3"><i data-lucide="briefcase-business" class="w-4 h-4 text-gray-400"></i> Celana</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index', ['category' => 'outer']) }}" class="flex items-center justify-between px-3 py-2 text-sm text-gray-600 hover:bg-orange-50 hover:text-primary rounded-lg transition-colors">
                        <span class="flex items-center gap-3"><i data-lucide="layers-2" class="w-4 h-4 text-gray-400"></i> Outerwear</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index', ['category' => 'hijab']) }}" class="flex items-center justify-between px-3 py-2 text-sm text-gray-600 hover:bg-orange-50 hover:text-primary rounded-lg transition-colors">
                        <span class="flex items-center gap-3"><i data-lucide="sparkles" class="w-4 h-4 text-gray-400"></i> Hijab & Aksesoris</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Hero Banner -->
        <div class="col-span-1 lg:col-span-3">
            <div class="relative bg-gray-950 rounded-2xl overflow-hidden min-h-[380px] md:min-h-[440px] flex items-center group shadow-md border border-gray-100">
                <!-- Background Image: Fokus Murni Produk Pakaian -->
                <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?auto=format&fit=crop&w=1400&q=85" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700" alt="Produk Pakaian Premium ALLWEAR FASHION">
                
                <!-- Dark Gradient Overlay for Crisp White Title -->
                <div class="absolute inset-0 bg-gradient-to-r from-gray-950/90 via-gray-950/75 to-transparent z-10"></div>
                
                <div class="relative z-20 px-6 sm:px-10 md:px-14 py-10 max-w-xl">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 bg-primary text-white rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i> Koleksi Baru 2026
                    </span>
                    
                    <!-- White Bold Title -->
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-[1.15] mb-4 tracking-tight drop-shadow-md">
                        Gaya effortless untuk setiap momen
                    </h2>
                    
                    <!-- Description without background, 100% solid white text -->
                    <p class="text-white text-sm sm:text-base leading-relaxed mb-8 max-w-lg drop-shadow-md font-medium">
                        Temukan pilihan pakaian premium dengan bahan nyaman, potongan modern, dan warna yang mudah dipadukan untuk gaya harianmu.
                    </p>
                    
                    <!-- Neat CTA Buttons -->
                    <div class="flex items-center gap-3.5">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2.5 bg-primary hover:bg-primary-hover text-white px-7 py-3.5 rounded-xl font-bold text-sm tracking-wide transition-all shadow-lg shadow-orange-500/30 hover:shadow-orange-500/45 hover:-translate-y-0.5 active:translate-y-0">
                            <span>Lihat Koleksi</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        <a href="{{ route('products.index', ['product_types' => ['Siap Dikirim']]) }}" class="inline-flex items-center justify-center bg-white/90 hover:bg-white text-gray-900 px-6 py-3.5 rounded-xl font-bold text-sm transition-all shadow-sm hover:shadow hover:-translate-y-0.5">
                            <span>Siap Dikirim</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Pilihan Terbaik Untukmu</h2>
            <a href="{{ route('products.index') }}" class="text-primary font-medium text-sm hover:underline flex items-center">
                Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($featured as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
    
    <!-- Banner Koleksi Promo -->
    <section class="rounded-2xl overflow-hidden relative min-h-[220px] flex items-center shadow-md">
        <!-- Banner Background Image: Fokus Murni Produk Pakaian -->
        <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&w=1400&q=85" class="absolute inset-0 w-full h-full object-cover object-center" alt="Promo Produk Koleksi Pakaian">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-950/85 via-gray-900/60 to-transparent"></div>
        
        <div class="relative z-10 p-8 md:p-12 w-full flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="max-w-xl text-white">
                <span class="inline-block text-xs font-bold uppercase tracking-wider text-orange-400 mb-1">Penawaran Eksklusif</span>
                <h3 class="text-2xl md:text-3xl font-bold mb-3">Lengkapi Gaya Harianmu</h3>
                <p class="text-gray-200 text-sm md:text-base mb-0">Nikmati diskon hingga 30% untuk koleksi pakaian pilihan. Tampil nyaman, tetap stylish dan percaya diri.</p>
            </div>
            <div class="shrink-0">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-white text-gray-950 font-bold px-8 py-3.5 rounded-xl hover:bg-orange-50 hover:text-primary transition-all shadow-lg hover:-translate-y-0.5">
                    <span>Lihat Promo</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Paling Banyak Dibeli</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($bestSellers as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

</div>
@endsection
