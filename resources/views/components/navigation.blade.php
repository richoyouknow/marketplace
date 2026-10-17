<nav class="hidden lg:block bg-white border-b border-gray-200" aria-label="Navigasi utama">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-8">
        <ul class="flex items-center gap-1 min-w-0 overflow-visible text-sm font-medium text-gray-600">
            <li class="relative border-r border-gray-200 pr-2">
                <details class="group">
                    <summary id="categoryMenuButton" class="flex items-center gap-2 py-3 px-3 hover:text-primary transition whitespace-nowrap cursor-pointer list-none">
                        <i data-lucide="layout-grid" class="w-4 h-4 text-gray-400 group-open:text-primary"></i>
                        <span>Kategori</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <div id="categoryMenu" class="absolute top-full left-0 w-[min(600px,calc(100vw-2rem))] bg-white border border-gray-200 shadow-xl rounded-b-xl z-50 p-6 grid grid-cols-3 gap-6">
                        <div>
                            <h4 class="font-bold text-gray-900 mb-3">Pakaian</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('products.index', ['category' => 'kemeja']) }}" class="text-gray-500 hover:text-primary">Kemeja</a></li>
                                <li><a href="{{ route('products.index', ['category' => 'dress']) }}" class="text-gray-500 hover:text-primary">Dress</a></li>
                                <li><a href="{{ route('products.index', ['category' => 'kaos']) }}" class="text-gray-500 hover:text-primary">Kaos</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-3">Pelengkap Gaya</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('products.index', ['category' => 'celana']) }}" class="text-gray-500 hover:text-primary">Celana</a></li>
                                <li><a href="{{ route('products.index', ['category' => 'outer']) }}" class="text-gray-500 hover:text-primary">Outerwear</a></li>
                                <li><a href="{{ route('products.index', ['category' => 'hijab']) }}" class="text-gray-500 hover:text-primary">Hijab</a></li>
                            </ul>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg flex flex-col justify-center items-center text-center">
                            <i data-lucide="zap" class="w-8 h-8 text-primary mb-2"></i>
                            <h4 class="font-bold text-gray-900">Promo Kilat</h4>
                            <p class="text-xs text-gray-500 mt-1">Diskon hingga 50% untuk koleksi fashion pilihan</p>
                        </div>
                    </div>
                </details>
            </li>
            
            <li>
                <a href="{{ route('products.index', ['product_types' => ['Siap Dikirim']]) }}" class="block py-3 px-3 hover:text-primary transition whitespace-nowrap">Siap dikirim</a>
            </li>
            <li>
                <a href="{{ route('products.index', ['category' => 'outer']) }}" class="block py-3 px-3 hover:text-primary transition whitespace-nowrap">Koleksi Outer</a>
            </li>
            <li>
                <a href="{{ route('products.index', ['nearby' => 1]) }}" class="flex items-center gap-1 py-3 px-3 hover:text-primary transition whitespace-nowrap">
                    <i data-lucide="map-pin" class="w-4 h-4 text-gray-400"></i>
                    Barang Terdekat
                </a>
            </li>
            <li>
                <a href="{{ route('help') }}" class="flex items-center gap-1 py-3 px-3 hover:text-primary transition whitespace-nowrap">
                    Bantuan
                </a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="flex items-center gap-1 py-3 px-3 hover:text-primary transition whitespace-nowrap">
                    Tentang Kami
                </a>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="flex items-center gap-1 py-3 px-3 hover:text-primary transition whitespace-nowrap">
                    Kontak
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Mobile Navigation Drawer -->
<div x-show="mobileMenuOpen" class="fixed inset-0 z-50 lg:hidden" style="display: none;">
    <div class="fixed inset-0 bg-black/50" @click="mobileMenuOpen = false" x-transition.opacity></div>
    <div class="fixed inset-y-0 left-0 w-[280px] bg-white shadow-xl flex flex-col" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full">
        
        <div class="p-4 border-b flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('allwear-logo.png') }}" alt="Allwear" class="h-8 w-auto object-contain">
            </a>
            <button @click="mobileMenuOpen = false" aria-label="Tutup menu" class="text-gray-500 hover:text-gray-900">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        
        <div class="overflow-y-auto flex-1 p-4">
            <ul class="space-y-4 font-medium text-gray-700">
                <li>
                    <a href="{{ route('home') }}" class="block">Beranda</a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="block text-primary">Semua Produk</a>
                </li>
                <li class="pt-4 border-t">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block">Kategori</span>
                    <ul class="space-y-3 pl-2">
                         <li><a href="{{ route('products.index', ['category' => 'kemeja']) }}" class="block text-gray-600">Kemeja</a></li>
                         <li><a href="{{ route('products.index', ['category' => 'dress']) }}" class="block text-gray-600">Dress</a></li>
                         <li><a href="{{ route('products.index', ['category' => 'kaos']) }}" class="block text-gray-600">Kaos</a></li>
                    </ul>
                </li>
                <li class="pt-4 border-t">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block">Informasi</span>
                    <ul class="space-y-3 pl-2 text-sm">
                         <li><a href="{{ route('about') }}" class="block text-gray-600 hover:text-primary">Tentang ALLWEAR FASHION</a></li>
                         <li><a href="{{ route('contact') }}" class="block text-gray-600 hover:text-primary">Kontak Kami</a></li>
                         <li><a href="{{ route('help') }}" class="block text-gray-600 hover:text-primary">Pusat Bantuan</a></li>
                         <li><a href="{{ route('refund') }}" class="block text-gray-600 hover:text-primary">Kebijakan Refund</a></li>
                         <li><a href="{{ route('terms') }}" class="block text-gray-600 hover:text-primary">Syarat & Ketentuan</a></li>
                         <li><a href="{{ route('privacy') }}" class="block text-gray-600 hover:text-primary">Kebijakan Privasi</a></li>
                    </ul>
                </li>
                <li class="pt-4 border-t">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block">Pilih Bahasa / Language</span>
                    <div class="grid grid-cols-2 gap-2 text-xs font-semibold">
                        <a href="{{ route('lang.switch', 'id') }}" class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg border transition {{ app()->getLocale() === 'id' ? 'bg-primary text-white border-primary shadow-xs' : 'bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100' }}">
                            <span>Bahasa Indonesia</span>
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg border transition {{ app()->getLocale() === 'en' ? 'bg-primary text-white border-primary shadow-xs' : 'bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100' }}">
                            <span>English</span>
                        </a>
                    </div>
                </li>
                <li class="pt-4 border-t">
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full py-2.5 px-4 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary-hover transition-colors">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        <span>Masuk ke Akun</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

