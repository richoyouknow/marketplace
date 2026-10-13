<footer class="bg-white border-t border-gray-200 mt-12 pt-16 pb-8">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
            <!-- Brand -->
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-bold text-xl">
                        O
                    </div>
                    <span class="text-xl font-bold text-gray-900">Odaplace</span>
                </a>
                <p class="text-gray-500 text-sm mb-6 max-w-sm">
                    Platform marketplace belanja modern Indonesia. Menghadirkan produk terkurasi, sistem pembayaran terlindungi, serta pengiriman cepat ke seluruh nusantara.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition" aria-label="Facebook">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition" aria-label="Twitter">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition" aria-label="Instagram">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-bold text-gray-900 mb-4">Layanan Pelanggan</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="{{ route('help') }}" class="hover:text-primary transition">Pusat Bantuan (FAQ)</a></li>
                    <li><a href="{{ route('refund') }}" class="hover:text-primary transition">Kebijakan Refund & Retur</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-primary transition">Syarat & Ketentuan</a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:text-primary transition">Kebijakan Privasi</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold text-gray-900 mb-4">Tentang Perusahaan</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="{{ route('about') }}" class="hover:text-primary transition">Tentang Odaplace</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-primary transition">Hubungi Kami</a></li>
                    <li><a href="{{ route('products.index', ['nearby' => 1]) }}" class="hover:text-primary transition">Barang Terdekat</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold text-gray-900 mb-4">Belanja di Odaplace</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="{{ route('products.index') }}" class="hover:text-primary transition">Semua Produk</a></li>
                    <li><a href="{{ route('products.index', ['product_types' => ['Siap Dikirim']]) }}" class="hover:text-primary transition">Siap Dikirim</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'outer']) }}" class="hover:text-primary transition">Koleksi Outer</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Odaplace. Seluruh hak cipta dilindungi undang-undang.</p>
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                <a href="{{ route('terms') }}" class="hover:text-primary transition-colors">Syarat & Ketentuan</a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('privacy') }}" class="hover:text-primary transition-colors">Kebijakan Privasi</a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('refund') }}" class="hover:text-primary transition-colors">Kebijakan Refund</a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('contact') }}" class="hover:text-primary transition-colors">Kontak</a>
            </div>
        </div>
    </div>
</footer>

