@extends('layouts.app')

@section('title', 'Tentang Kami - Odaplace')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 lg:px-8 py-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <span class="text-gray-900 font-medium">Tentang Kami</span>
    </nav>

    <!-- Hero Section -->
    <section class="rounded-3xl bg-primary px-6 py-14 text-white shadow-lg sm:px-12 lg:px-16 lg:py-16 mb-12">
        <div class="max-w-2xl">
            <div class="mb-4 inline-flex items-center rounded-full border border-white/30 bg-white/15 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-white">
                Cerita & Perjalanan Kami
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl leading-tight text-white">
                Mendefinisikan Ulang Pengalaman Belanja Anda
            </h1>
            <p class="mt-5 text-sm sm:text-base leading-relaxed text-white/90">
                <strong>Odaplace</strong> lahir untuk menghadirkan platform belanja daring yang menghubungkan produk berkualitas, kurasi gaya terkini, serta kecepatan logistik yang aman ke seluruh penjuru Indonesia.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('products.index') }}" class="px-6 py-3.5 rounded-xl bg-white text-gray-900 font-bold text-sm hover:bg-orange-50 transition-colors shadow-lg flex items-center gap-2">
                    <i data-lucide="shopping-bag" class="w-4 h-4 text-primary"></i> Jelajahi Produk
                </a>
                <a href="{{ route('contact') }}" class="px-6 py-3.5 rounded-xl border border-white/40 text-white font-bold text-sm hover:bg-white/15 transition-colors flex items-center gap-2">
                    <i data-lucide="message-square" class="w-4 h-4"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Statistik Pencapaian -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-16">
        <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-sm">
            <span class="block text-3xl sm:text-4xl font-extrabold text-primary mb-1">10.000+</span>
            <span class="text-xs sm:text-sm font-semibold text-gray-700">Produk Terkurasi</span>
            <p class="text-[11px] text-gray-400 mt-1">Dipilih dengan standar mutu ketat</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-sm">
            <span class="block text-3xl sm:text-4xl font-extrabold text-primary mb-1">50.000+</span>
            <span class="text-xs sm:text-sm font-semibold text-gray-700">Pelanggan Puas</span>
            <p class="text-[11px] text-gray-400 mt-1">Tersebar di seluruh Indonesia</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-sm">
            <span class="block text-3xl sm:text-4xl font-extrabold text-primary mb-1">99.8%</span>
            <span class="text-xs sm:text-sm font-semibold text-gray-700">Transaksi Sukses</span>
            <p class="text-[11px] text-gray-400 mt-1">Pembayaran aman & bergaransi</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-sm">
            <span class="block text-3xl sm:text-4xl font-extrabold text-primary mb-1">34</span>
            <span class="text-xs sm:text-sm font-semibold text-gray-700">Provinsi Terjangkau</span>
            <p class="text-[11px] text-gray-400 mt-1">Didukung kurir ekspedisi nasional</p>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-orange-100 text-primary flex items-center justify-center font-bold mb-5">
                <i data-lucide="eye" class="w-6 h-6"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Visi Kami</h2>
            <p class="text-sm text-gray-600 leading-relaxed">
                Menjadi platform marketplace pilihan utama di Indonesia yang dipercaya karena transparansi, kemudahan akses lokasi penjual terdekat, serta kurasi produk berkualitas yang meningkatkan gaya hidup konsumen.
            </p>
        </div>

        <div class="bg-white border border-gray-200 rounded-3xl p-8 shadow-sm">
            <div class="w-12 h-12 rounded-2xl bg-orange-100 text-primary flex items-center justify-center font-bold mb-5">
                <i data-lucide="target" class="w-6 h-6"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Misi Kami</h2>
            <ul class="space-y-2.5 text-sm text-gray-600">
                <li class="flex items-start gap-2.5">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 shrink-0"></i>
                    <span>Menyediakan produk fashion dan gaya hidup original dengan harga kompetitif dan transparan.</span>
                </li>
                <li class="flex items-start gap-2.5">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 shrink-0"></i>
                    <span>Mengembangkan teknologi pencarian berbasis lokasi pintar (*Barang Terdekat*) demi efisiensi ongkos kirim.</span>
                </li>
                <li class="flex items-start gap-2.5">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500 mt-0.5 shrink-0"></i>
                    <span>Memprioritaskan keamanan pembayaran dan kecepatan respon layanan pelanggan 7 hari seminggu.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- 4 Nilai Utama Kami -->
    <section class="mb-16">
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-wider text-primary">Prinsip Kami</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-1">Mengapa Memilih Odaplace?</h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-2">Nilai-nilai inti yang selalu menjadi fondasi dalam setiap layanan kami kepada Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-orange-300 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center mb-4">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-2">100% Produk Terverifikasi</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Setiap produk lolos kurasi keaslian dan kondisi fisik sebelum dikirim ke pelanggan.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-orange-300 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center mb-4">
                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-2">Pencarian Terdekat</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Fitur pintar mencari stok barang dari seller atau gudang terdekat dengan lokasi Anda.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-orange-300 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center mb-4">
                    <i data-lucide="truck" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-2">Pengiriman Cepat</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Bekerja sama dengan kurir terpercaya seperti J&T, SiCepat, dan JNE dengan pelacakan resi real-time.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-orange-300 transition-colors">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center mb-4">
                    <i data-lucide="headset" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-sm mb-2">Dukungan Responsif</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Tim bantuan customer support ramah yang siap membantu kendala pesanan Anda setiap hari.</p>
            </div>
        </div>
    </section>

    <!-- Banner Call to Action -->
    <section class="rounded-3xl bg-gray-900 text-white p-8 sm:p-12 text-center relative overflow-hidden">
        <div class="relative max-w-xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold mb-3">Siap Menemukan Koleksi Terbaikmu?</h2>
            <p class="text-xs sm:text-sm text-gray-400 mb-6 leading-relaxed">
                Mulai belanja sekarang dan nikmati gratis ongkir, promo harian, dan pembayaran mudah di Odaplace.
            </p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-hover text-white px-7 py-3.5 rounded-xl font-bold text-sm transition-colors shadow-lg shadow-orange-500/30">
                <i data-lucide="shopping-cart" class="w-4 h-4"></i> Mulai Belanja Sekarang
            </a>
        </div>
    </section>
</div>
@endsection
