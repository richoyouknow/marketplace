@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan - ALLWEAR FASHION')

@section('content')
<div class="max-w-[1180px] mx-auto px-4 lg:px-8 py-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <span class="text-gray-900 font-medium">Syarat dan Ketentuan</span>
    </nav>

    <!-- Hero Banner -->
    <section class="rounded-3xl bg-primary px-6 py-12 text-white shadow-lg sm:px-10 lg:px-14 lg:py-14 mb-10">
        <div class="max-w-2xl">
            <div class="mb-4 inline-flex items-center rounded-full border border-white/30 bg-white/15 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-white">
                Ketentuan Resmi ALLWEAR FASHION
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl text-white">Syarat & Ketentuan Penggunaan</h1>
            <p class="mt-4 max-w-xl text-sm leading-relaxed text-white/90 sm:text-base">
                Harap baca syarat dan ketentuan ini dengan cermat sebelum menggunakan layanan platform e-commerce ALLWEAR FASHION.
            </p>
            <div class="mt-6 flex flex-wrap items-center gap-4 text-xs text-orange-100/80">
                <span class="flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4"></i> Terakhir Diperbarui: 13 Oktober 2026</span>
                <span>•</span>
                <span class="flex items-center gap-1.5"><i data-lucide="shield-check" class="w-4 h-4"></i> Berlaku untuk Seluruh Pengguna</span>
            </div>
        </div>
    </section>

    <!-- Konten Utama -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Menu Navigasi -->
        <aside class="hidden lg:block lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm sticky top-24">
                <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wider mb-3">Daftar Isi</h3>
                <nav class="space-y-1 text-xs">
                    <a href="#definisi" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-orange-50 hover:text-primary transition font-medium">1. Definisi & Ketentuan Umum</a>
                    <a href="#akun" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-orange-50 hover:text-primary transition font-medium">2. Akun & Keamanan Pengguna</a>
                    <a href="#transaksi" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-orange-50 hover:text-primary transition font-medium">3. Pemesanan & Pembayaran</a>
                    <a href="#pengiriman" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-orange-50 hover:text-primary transition font-medium">4. Pengiriman & Penerimaan</a>
                    <a href="#retur" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-orange-50 hover:text-primary transition font-medium">5. Pembatalan & Retur</a>
                    <a href="#hki" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-orange-50 hover:text-primary transition font-medium">6. Hak Kekayaan Intelektual</a>
                    <a href="#hukum" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-orange-50 hover:text-primary transition font-medium">7. Hukum yang Berlaku</a>
                </nav>

                <div class="mt-6 pt-5 border-t border-gray-100 text-xs text-gray-500">
                    <p class="mb-2">Butuh bantuan ketentuan?</p>
                    <a href="{{ route('contact') }}" class="text-primary font-bold hover:underline inline-flex items-center gap-1">
                        Hubungi Tim Legal <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Dokumen Ketentuan -->
        <div class="lg:col-span-3 space-y-8">
            <!-- 1. Definisi -->
            <section id="definisi" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-orange-100 text-primary flex items-center justify-center font-bold text-sm">01</span>
                    <h2 class="text-xl font-bold text-gray-900">Definisi & Ketentuan Umum</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        Selamat datang di <strong>ALLWEAR FASHION</strong> ("Platform", "Kami"). Dengan mendaftar, mengakses, atau berbelanja di website ini, Anda secara sadar menyetujui untuk terikat oleh Syarat dan Ketentuan ini serta seluruh kebijakan yang tercantum di dalamnya.
                    </p>
                    <ul class="list-disc pl-5 space-y-2 text-gray-600">
                        <li><strong>Platform:</strong> Portal e-commerce resmi ALLWEAR FASHION beserta fitur, aplikasi, dan subdomain terkait.</li>
                        <li><strong>Pengguna:</strong> Pihak yang mengakses Platform, termasuk pembeli terdaftar maupun pengunjung situs.</li>
                        <li><strong>Barang / Produk:</strong> Barang fisik (fashion, apparel, aksesoris, dan produk lainnya) yang diperjualbelikan melalui ALLWEAR FASHION.</li>
                        <li><strong>Pesanan:</strong> Permintaan pembelian Barang yang diajukan Pengguna melalui sistem checkout Platform.</li>
                    </ul>
                </div>
            </section>

            <!-- 2. Akun -->
            <section id="akun" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-orange-100 text-primary flex items-center justify-center font-bold text-sm">02</span>
                    <h2 class="text-xl font-bold text-gray-900">Akun & Keamanan Pengguna</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        Untuk menikmati fasilitas checkout, pelacakan pesanan, dan wishlist, Pengguna disarankan membuat akun resmi di ALLWEAR FASHION:
                    </p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Pengguna wajib memberikan informasi pendaftaran yang akurat, jujur, dan selalu terkini.</li>
                        <li>Pengguna bertanggung jawab penuh atas kerahasiaan kata sandi (password) serta seluruh aktivitas yang terjadi dalam akun.</li>
                        <li>ALLWEAR FASHION berhak menangguhkan atau membatasi akun Pengguna jika ditemukan indikasi penyalahgunaan, aktivitas penipuan, atau pelanggaran hukum yang berlaku di Indonesia.</li>
                    </ul>
                </div>
            </section>

            <!-- 3. Transaksi & Pembayaran -->
            <section id="transaksi" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-orange-100 text-primary flex items-center justify-center font-bold text-sm">03</span>
                    <h2 class="text-xl font-bold text-gray-900">Pemesanan & Metode Pembayaran</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        Seluruh harga produk dicantumkan dalam mata uang <strong>Rupiah (IDR)</strong> dan telah diperhitungkan secara transparan pada formulir pembayaran sebelum konfirmasi pesanan:
                    </p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Metode Resmi:</strong> ALLWEAR FASHION memfasilitasi pembayaran melalui Transfer Bank (Virtual Account), E-Wallet resmi (GoPay, OVO, DANA), dan COD (Bayar di Tempat).</li>
                        <li><strong>Batas Waktu Pembayaran:</strong> Untuk metode transfer virtual account atau e-wallet, pesanan wajib diselesaikan dalam jangka waktu maksimal 24 jam sebelum kode transaksi kedaluwarsa secara otomatis.</li>
                        <li><strong>Konfirmasi Harga:</strong> Kami berupaya menjaga keakuratan harga katalog. Apabila terjadi kesalahan pencantuman harga teknis yang nyata, kami berhak menghubungi pembeli untuk penyesuaian atau pembatalan pesanan secara adil.</li>
                    </ul>
                </div>
            </section>

            <!-- 4. Pengiriman -->
            <section id="pengiriman" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-orange-100 text-primary flex items-center justify-center font-bold text-sm">04</span>
                    <h2 class="text-xl font-bold text-gray-900">Pengiriman & Penerimaan Produk</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        Pengiriman pesanan dilakukan melalui mitra logistik terpercaya (J&T Express, SiCepat, JNE, dll) ke seluruh wilayah Republik Indonesia:
                    </p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Pengguna bertanggung jawab memastikan alamat penerima, nomor telepon, kecamatan, kelurahan, dan kode pos diisi dengan tepat.</li>
                        <li>Estimasi pengiriman (Reguler 2–5 hari kerja, Express 1–2 hari kerja) merupakan perkiraan waktu dari mitra kurir dan dapat dipengaruhi oleh kondisi cuaca atau hari libur nasional.</li>
                        <li>Klausul serah terima barang dianggap sah ketika mitra kurir menyerahkan paket ke alamat tujuan yang tercantum pada resi pelacakan.</li>
                    </ul>
                </div>
            </section>

            <!-- 5. Retur & Pembatalan -->
            <section id="retur" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-orange-100 text-primary flex items-center justify-center font-bold text-sm">05</span>
                    <h2 class="text-xl font-bold text-gray-900">Pembatalan & Pengembalian Dana (Refund)</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        Ketentuan retur dan pengembalian dana diatur secara terperinci dalam <a href="{{ route('refund') }}" class="text-primary font-bold hover:underline">Kebijakan Refund ALLWEAR FASHION</a>. Secara umum:
                    </p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Klaim retur dapat diajukan maksimal <strong>2x24 jam</strong> sejak status paket dinyatakan diterima.</li>
                        <li>Pengguna diwajibkan menyertakan video unboxing utuh tanpa jeda sebagai bukti pendukung utama apabila barang cacat atau tidak sesuai pesanan.</li>
                    </ul>
                </div>
            </section>

            <!-- 6. HKI -->
            <section id="hki" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-orange-100 text-primary flex items-center justify-center font-bold text-sm">06</span>
                    <h2 class="text-xl font-bold text-gray-900">Hak Kekayaan Intelektual</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed">
                    <p>
                        Seluruh logo, merek dagang ALLWEAR FASHION, tata letak antarmuka, grafis, teks, dan kode perangkat lunak dilindungi oleh undang-undang hak cipta dan merek Republik Indonesia. Dilarang keras menyalin, memodifikasi, atau mendistribusikan aset platform tanpa izin tertulis dari ALLWEAR FASHION.
                    </p>
                </div>
            </section>

            <!-- 7. Hukum -->
            <section id="hukum" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-orange-100 text-primary flex items-center justify-center font-bold text-sm">07</span>
                    <h2 class="text-xl font-bold text-gray-900">Hukum yang Berlaku & Kontak</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-4">
                    <p>
                        Syarat dan Ketentuan ini tunduk dan ditafsirkan sesuai dengan hukum yang berlaku di <strong>Negara Kesatuan Republik Indonesia</strong>. Segala perselisihan akan diselesaikan secara musyawarah untuk mufakat terlebih dahulu sebelum menempuh jalur hukum.
                    </p>
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-between">
                        <div>
                            <p class="font-bold text-gray-900">Pertanyaan seputar Syarat & Ketentuan?</p>
                            <p class="text-xs text-gray-500">Tim bantuan ALLWEAR FASHION siap memberikan klarifikasi.</p>
                        </div>
                        <a href="{{ route('contact') }}" class="px-4 py-2 bg-primary hover:bg-primary-hover text-white text-xs font-bold rounded-lg transition-colors">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
