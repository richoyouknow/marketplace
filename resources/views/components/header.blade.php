<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-200">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 sm:gap-5 min-h-[72px]">
            <!-- Logo & Mobile Menu Toggle -->
            <div class="flex items-center gap-3 shrink-0">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Buka menu" class="lg:hidden text-gray-500 hover:text-primary transition">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <img src="{{ asset('allwear-logo.png') }}" alt="Allwear" class="h-9 sm:h-11 w-auto object-contain transition-transform duration-200 group-hover:scale-105">
                </a>
            </div>

            <!-- Search Bar -->
            <div class="hidden md:flex flex-1 min-w-0 max-w-2xl mx-auto">
                <form action="{{ route('products.index') }}" method="GET" class="w-full flex items-center border border-gray-300 rounded-full bg-gray-50 overflow-hidden focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20 transition-all pl-4">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400 shrink-0"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari koleksi pakaian ALLWEAR..." class="min-w-0 flex-1 bg-transparent px-3 py-2.5 text-sm focus:outline-none">
                    <button type="submit" class="shrink-0 bg-gray-900 text-white px-5 py-2 m-1 rounded-full text-sm font-medium hover:bg-primary transition-colors">Cari</button>
                </form>
            </div>

            <!-- User Actions -->
            <div class="ml-auto shrink-0 flex items-center gap-3 sm:gap-5">
                <!-- Language Switcher -->
                <div class="relative hidden sm:block" x-data="{ langOpen: false }">
                    <button type="button" @click="langOpen = !langOpen" @click.outside="langOpen = false" 
                            class="flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded-full border border-gray-200 hover:border-gray-300 bg-gray-50 text-gray-700 transition">
                        <i data-lucide="globe" class="w-3.5 h-3.5 text-gray-500"></i>
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                        <i data-lucide="chevron-down" class="w-3 h-3 text-gray-400 transition-transform duration-200" :class="langOpen ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="langOpen" x-transition.origin.top.right 
                         class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-xl border border-gray-100 py-1.5 z-50 text-xs font-medium" 
                         style="display: none;">
                        <a href="{{ route('lang.switch', 'id') }}" 
                           class="flex items-center justify-between px-3.5 py-2 hover:bg-orange-50 hover:text-primary transition {{ app()->getLocale() === 'id' ? 'text-primary font-bold bg-orange-50/60' : 'text-gray-700' }}">
                            <span>Bahasa Indonesia</span>
                            @if(app()->getLocale() === 'id') <i data-lucide="check" class="w-3.5 h-3.5 text-primary"></i> @endif
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" 
                           class="flex items-center justify-between px-3.5 py-2 hover:bg-orange-50 hover:text-primary transition {{ app()->getLocale() === 'en' ? 'text-primary font-bold bg-orange-50/60' : 'text-gray-700' }}">
                            <span>English</span>
                            @if(app()->getLocale() === 'en') <i data-lucide="check" class="w-3.5 h-3.5 text-primary"></i> @endif
                        </a>
                    </div>
                </div>
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
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari koleksi pakaian ALLWEAR..." class="min-w-0 flex-1 bg-transparent px-4 py-2.5 text-sm focus:outline-none">
                <button type="submit" aria-label="Cari" class="shrink-0 bg-gray-900 text-white p-2 m-1 rounded-full hover:bg-primary transition-colors"><i data-lucide="search" class="w-4 h-4"></i></button>
            </form>
        </div>
    </div>
</header>

