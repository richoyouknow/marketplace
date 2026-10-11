<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 sm:gap-5 min-h-[72px]">
            <!-- Logo & Mobile Menu Toggle -->
            <div class="flex items-center gap-3 shrink-0">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Buka menu" class="lg:hidden text-gray-500 hover:text-primary transition">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-bold text-xl">O</div>
                    <span class="text-xl font-bold text-gray-900 hidden sm:block">Odaplace</span>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="hidden md:flex flex-1 min-w-0 max-w-3xl mx-auto">
                <form action="{{ route('products.index') }}" method="GET" class="w-full flex items-center border border-gray-300 rounded-full bg-gray-50 overflow-hidden focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all">
                    <div class="hidden lg:flex items-center px-4 py-2 border-r border-gray-300 bg-white min-w-[120px]">
                        <i data-lucide="map-pin" class="w-4 h-4 text-gray-400 mr-2"></i>
                        <span class="text-sm text-gray-500">Jakarta</span>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk atau merek..." class="min-w-0 flex-1 bg-transparent px-4 py-2.5 text-sm focus:outline-none">
                    <button type="submit" class="shrink-0 bg-gray-900 text-white px-5 py-2 m-1 rounded-full text-sm font-medium hover:bg-primary transition-colors">Cari</button>
                </form>
            </div>

            <!-- User Actions -->
            <div class="ml-auto shrink-0 flex items-center gap-3 sm:gap-5">
                <button type="button" class="hidden lg:flex items-center gap-1 text-sm text-gray-600 hover:text-gray-900">
                    <span>ID</span>
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </button>
                <div class="flex items-center gap-3 sm:gap-4">
                    <a href="{{ route('wishlist.index') }}" aria-label="Wishlist" class="text-gray-600 hover:text-primary transition relative">
                        <i data-lucide="heart" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    </a>
                    <a href="{{ route('cart.index') }}" aria-label="Keranjang" class="text-gray-600 hover:text-primary transition relative">
                        <i data-lucide="shopping-cart" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                        @php $cartCount = app(\App\Services\CartService::class)->getCount(); @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 bg-primary hover:bg-primary-hover text-white text-xs sm:text-sm font-semibold px-4 py-2 rounded-full transition-colors shadow-xs">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        <span>Masuk</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Search -->
        <div class="md:hidden pb-4">
            <form action="{{ route('products.index') }}" method="GET" class="w-full flex items-center border border-gray-300 rounded-full bg-gray-50 overflow-hidden focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk atau merek..." class="min-w-0 flex-1 bg-transparent px-4 py-2.5 text-sm focus:outline-none">
                <button type="submit" aria-label="Cari" class="shrink-0 bg-gray-900 text-white p-2 m-1 rounded-full hover:bg-primary transition-colors"><i data-lucide="search" class="w-4 h-4"></i></button>
            </form>
        </div>
    </div>
</header>

