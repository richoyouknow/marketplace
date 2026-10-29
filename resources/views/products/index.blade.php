@extends('layouts.app')

@section('title', 'Koleksi Resmi - ALLWEAR FASHION')

@section('content')
<div class="max-w-[1440px] mx-auto px-4 lg:px-8" x-data="{ filterDrawerOpen: false }">
    
    <!-- Top section with breadcrumbs and title -->
    <div class="py-4 flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span class="text-gray-900 font-medium">Koleksi ALLWEAR</span>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filter (Desktop) -->
        <aside class="hidden lg:block w-64 shrink-0">
            <form action="{{ route('products.index') }}" method="GET" id="filterForm" class="space-y-6 sticky top-24">
                
                @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                
                <!-- Active Filters Header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-gray-900 text-lg">Filter</h3>
                </div>

                <!-- Kategori Koleksi -->
                <div class="space-y-3">
                    <h4 class="font-bold text-gray-900 text-sm">Kategori Koleksi</h4>
                    <div class="space-y-1.5 text-sm">
                        <a href="{{ route('products.index', request()->except(['category', 'page'])) }}" class="flex items-center justify-between py-1.5 px-2.5 rounded-lg transition {{ !request('category') ? 'font-bold text-primary bg-primary/10' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">
                            <span>Semua Kategori</span>
                        </a>
                        @foreach(['kemeja' => 'Kemeja', 'dress' => 'Dress', 'kaos' => 'Kaos', 'celana' => 'Celana', 'outer' => 'Outerwear', 'hijab' => 'Hijab & Aksesoris', 'blouse' => 'Blouse', 'rok' => 'Rok'] as $catKey => $catLabel)
                        <a href="{{ route('products.index', array_merge(request()->except(['page']), ['category' => $catKey])) }}" class="flex items-center justify-between py-1.5 px-2.5 rounded-lg transition {{ request('category') === $catKey ? 'font-bold text-primary bg-primary/10' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">
                            <span>{{ $catLabel }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <hr class="border-gray-200">

                <!-- Ketersediaan -->
                <div class="space-y-3">
                    <h4 class="font-bold text-gray-900 text-sm">Ketersediaan</h4>
                    <div class="space-y-2">
                        @php $productTypes = (array) request('product_types', []); @endphp
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="product_types[]" value="Siap Dikirim" @if(in_array('Siap Dikirim', $productTypes)) checked @endif class="peer appearance-none w-5 h-5 border border-gray-300 rounded checked:bg-primary checked:border-primary transition-colors cursor-pointer">
                                <i data-lucide="check" class="absolute w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                            </div>
                            <span class="text-sm text-gray-600 group-hover:text-gray-900">Siap Dikirim</span>
                        </label>
                    </div>
                </div>

                <hr class="border-gray-200">

                <!-- Kondisi -->
                <div class="space-y-3">
                    <h4 class="font-bold text-gray-900 text-sm">Kondisi</h4>
                    <div class="space-y-2">
                        @php $conditions = (array) request('condition', []); @endphp
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="condition[]" value="Baru" @if(in_array('Baru', $conditions, true)) checked @endif class="peer appearance-none w-5 h-5 border border-gray-300 rounded checked:bg-primary checked:border-primary transition-colors cursor-pointer">
                                <i data-lucide="check" class="absolute w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none"></i>
                            </div>
                            <span class="text-sm text-gray-600 group-hover:text-gray-900">Baru</span>
                        </label>
                    </div>
                </div>

                <!-- Jumlah Minimum -->
                <div class="space-y-4" x-data="{ minOrder: '{{ request('min_order', 1) }}' }">
                    <h4 class="font-bold text-gray-900 text-sm flex items-center justify-between">
                        Pesanan Minimum
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs font-bold" x-text="minOrder + ' pcs'"></span>
                    </h4>
                    <input type="range" name="min_order" x-model="minOrder" min="1" max="40" class="w-full h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary">
                    <div class="flex justify-between text-xs text-gray-400"><span>1</span><span>40</span></div>
                </div>

                <hr class="border-gray-200">

                <!-- Rentang Harga -->
                <div class="space-y-3">
                    <h4 class="font-bold text-gray-900 text-sm">Rentang Harga</h4>
                    <div class="flex items-center gap-2">
                        <div class="relative flex-1"><span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">Rp</span><input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="79000" class="w-full border border-gray-300 rounded-lg pl-9 pr-2 py-2 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"></div>
                        <span class="text-gray-400">-</span>
                        <div class="relative flex-1"><span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">Rp</span><input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="500000" class="w-full border border-gray-300 rounded-lg pl-9 pr-2 py-2 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"></div>
                    </div>
                    <div class="space-y-1 mt-4">
                        <label class="block cursor-pointer"><input type="radio" name="price_range" value="under_200" class="peer hidden" onchange="document.querySelector('[name=min_price]').value=''; document.querySelector('[name=max_price]').value='200000'; this.form.submit();"><div class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary hover:text-primary transition-colors text-center">Di bawah Rp200 ribu</div></label>
                        <label class="block cursor-pointer"><input type="radio" name="price_range" value="200_300" class="peer hidden" onchange="document.querySelector('[name=min_price]').value='200000'; document.querySelector('[name=max_price]').value='300000'; this.form.submit();"><div class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary hover:text-primary transition-colors text-center">Rp200 - Rp300 ribu</div></label>
                        <label class="block cursor-pointer"><input type="radio" name="price_range" value="over_300" class="peer hidden" onchange="document.querySelector('[name=min_price]').value='300000'; document.querySelector('[name=max_price]').value=''; this.form.submit();"><div class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary hover:text-primary transition-colors text-center">Di atas Rp300 ribu</div></label>
                    </div>
                </div>
                <button type="submit" class="w-full bg-primary text-white font-medium py-2 rounded-lg hover:bg-primary-hover transition">Terapkan Filter</button>
            </form>
        </aside>

        <!-- Product Area -->
        <div class="flex-1 min-w-0">
            
            <!-- Mobile Filter Button -->
            <button @click="filterDrawerOpen = true" class="lg:hidden w-full flex items-center justify-center gap-2 border border-gray-300 rounded-lg py-2 font-medium mb-4">
                <i data-lucide="sliders-horizontal" class="w-4 h-4"></i> Filter & Urutkan
            </button>

            <!-- Results Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-gray-900 font-bold">
                        {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} koleksi resmi ALLWEAR {{ request('search') ? 'untuk "' . request('search') . '"' : '' }}
                    </h1>
                </div>

                <div class="flex items-center gap-4 self-end sm:self-auto">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">Urutkan:</span>
                        <select name="sort" form="filterForm" onchange="document.getElementById('filterForm').submit()" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white cursor-pointer">
                            <option value="best_match" {{ request('sort') == 'best_match' ? 'selected' : '' }}>Paling Relevan</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        </select>
                    </div>
                    
                    <div class="hidden sm:flex border border-gray-200 rounded-lg p-1 bg-white">
                        <button class="p-1.5 rounded bg-gray-100 text-gray-900"><i data-lucide="layout-grid" class="w-4 h-4"></i></button>
                        <button class="p-1.5 rounded text-gray-400 hover:text-gray-900"><i data-lucide="list" class="w-4 h-4"></i></button>
                    </div>
                </div>
            </div>

            <!-- Nearby location banner -->
            @if(request('nearby'))
            <div class="mb-6 rounded-2xl border border-orange-100 bg-gradient-to-r from-orange-50 to-amber-50 p-5">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-white text-primary flex items-center justify-center shadow-sm shrink-0"><i data-lucide="map-pin" class="w-5 h-5"></i></div>
                        <div>
                            <h2 class="font-bold text-gray-900">Pengiriman Terdekat ke Lokasi Kamu</h2>
                            <p id="nearbyLocationStatus" class="text-sm text-gray-600 mt-1">Izinkan akses lokasi agar produk dengan estimasi rute pengiriman terdekat ke alamat kamu ditampilkan lebih awal.</p>
                        </div>
                    </div>
                    <form id="nearbyLocationForm" action="{{ route('products.index') }}" method="GET" class="shrink-0">
                        @foreach(request()->except(['latitude', 'longitude', 'page']) as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $item)<input type="hidden" name="{{ $key }}[]" value="{{ $item }}">@endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <input type="hidden" name="latitude" id="nearbyLatitude" value="{{ request('latitude') }}">
                        <input type="hidden" name="longitude" id="nearbyLongitude" value="{{ request('longitude') }}">
                        <button type="button" id="enableNearbyLocation" class="text-sm font-bold text-primary hover:underline whitespace-nowrap">Gunakan lokasi saya</button>
                    </form>
                </div>
            </div>
            <script>
                document.getElementById('enableNearbyLocation')?.addEventListener('click', function () {
                    const status = document.getElementById('nearbyLocationStatus');
                    if (!navigator.geolocation) {
                        status.textContent = 'Browser ini tidak mendukung akses lokasi.';
                        return;
                    }
                    status.textContent = 'Meminta izin lokasi...';
                    navigator.geolocation.getCurrentPosition(function (position) {
                        document.getElementById('nearbyLatitude').value = position.coords.latitude;
                        document.getElementById('nearbyLongitude').value = position.coords.longitude;
                        status.textContent = 'Lokasi aktif. Menampilkan koleksi ALLWEAR dengan rute pengiriman terdekat.';
                        document.getElementById('nearbyLocationForm').submit();
                    }, function () {
                        status.textContent = 'Akses lokasi ditolak. Izinkan lokasi di browser untuk estimasi pengiriman terdekat.';
                    }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 300000 });
                });
            </script>
            @endif

            <!-- Active Filter Chips -->
            <div class="flex flex-wrap items-center gap-2 mb-6">
                @if(request('category'))
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 text-xs font-medium text-gray-700 bg-white shadow-sm">
                    Kategori: {{ ucfirst(request('category')) }} 
                    <a href="{{ route('products.index', request()->except(['category', 'page'])) }}" class="text-gray-400 hover:text-gray-900"><i data-lucide="x" class="w-3 h-3"></i></a>
                </span>
                @endif
                
                @foreach((array) request('product_types', []) as $type)
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 text-xs font-medium text-gray-700 bg-white shadow-sm">
                    {{ $type }} <i data-lucide="x" class="w-3 h-3 text-gray-400 cursor-pointer hover:text-gray-900"></i>
                </span>
                @endforeach
                
                @if(request('min_price'))
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 text-xs font-medium text-gray-700 bg-white shadow-sm">
                    Harga minimum <i data-lucide="x" class="w-3 h-3 text-gray-400 cursor-pointer hover:text-gray-900"></i>
                </span>
                @endif
                
                @if(request('max_price'))
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200 text-xs font-medium text-gray-700 bg-white shadow-sm">
                    Harga maksimum <i data-lucide="x" class="w-3 h-3 text-gray-400 cursor-pointer hover:text-gray-900"></i>
                </span>
                @endif

                @if(request()->except(['page', 'sort', 'search']))
                <a href="{{ route('products.index') }}" class="text-sm font-bold text-primary hover:underline ml-2">Hapus Semua Filter</a>
                @endif
            </div>

            <!-- Product Grid -->
            @if($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                @foreach($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $products->links('pagination::tailwind') }}
            </div>
            
            @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl border border-gray-200 p-12 text-center flex flex-col items-center justify-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="search-x" class="w-8 h-8 text-gray-400"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Produk tidak ditemukan</h3>
                <p class="text-gray-500 max-w-md mx-auto mb-6">Kami tidak menemukan produk yang sesuai dengan filter Anda. Coba ubah pencarian atau hapus beberapa filter.</p>
                <a href="{{ route('products.index') }}" class="bg-primary text-white font-medium px-6 py-2 rounded-lg hover:bg-primary-hover transition">
                    Hapus Filter
                </a>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection


