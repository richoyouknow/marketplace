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
                    Premium e-commerce platform offering the best products globally. We connect verified suppliers with buyers around the world.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-bold text-gray-900 mb-4">Customer Services</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="{{ route('help') }}" class="hover:text-primary transition">Pusat Bantuan</a></li>
                    <li><a href="#" class="hover:text-primary transition">Report Abuse</a></li>
                    <li><a href="#" class="hover:text-primary transition">Submit a Dispute</a></li>
                    <li><a href="#" class="hover:text-primary transition">Policies & Rules</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold text-gray-900 mb-4">About Us</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-primary transition">About Odaplace</a></li>
                    <li><a href="#" class="hover:text-primary transition">About Group</a></li>
                    <li><a href="#" class="hover:text-primary transition">Sitemap</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold text-gray-900 mb-4">Buy on Odaplace</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-primary transition">Semua Kategori</a></li>
                    <li><a href="#" class="hover:text-primary transition">Request for Quotation</a></li>
                    <li><a href="#" class="hover:text-primary transition">Ready to Ship</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Odaplace.com. All rights reserved.</p>
            <div class="flex items-center gap-4 text-sm text-gray-500">
                <a href="#" class="hover:text-gray-900">Terms of Use</a>
                <span class="text-gray-300">|</span>
                <a href="#" class="hover:text-gray-900">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

