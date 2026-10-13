@extends('layouts.app')

@section('title', 'Kebijakan Privasi - Odaplace')

@section('content')
<div class="max-w-[1180px] mx-auto px-4 lg:px-8 py-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <span class="text-gray-900 font-medium">Kebijakan Privasi</span>
    </nav>

    <!-- Hero Banner -->
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#121c24] via-[#1f3747] to-[#0284c7] px-6 py-12 text-white shadow-xl sm:px-10 lg:px-14 lg:py-14 mb-10">
        <div class="absolute -right-16 -top-20 h-64 w-64 rounded-full bg-cyan-300/20 blur-3xl"></div>
        <div class="relative max-w-2xl">
            <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-cyan-100">
                <i data-lucide="lock" class="h-3.5 w-3.5"></i> Perlindungan Data Pribadi
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl">Kebijakan Privasi Odaplace</h1>
            <p class="mt-4 max-w-xl text-sm leading-relaxed text-cyan-50/85 sm:text-base">
                Kami berkomitmen menjaga kerahasiaan dan keamanan data pribadi Anda sesuai regulasi UU Perlindungan Data Pribadi (UU PDP) Republik Indonesia.
            </p>
            <div class="mt-6 flex flex-wrap items-center gap-4 text-xs text-cyan-100/80">
                <span class="flex items-center gap-1.5"><i data-lucide="clock" class="w-4 h-4"></i> Terakhir Diperbarui: Oktober 2026</span>
                <span>•</span>
                <span class="flex items-center gap-1.5"><i data-lucide="shield" class="w-4 h-4"></i> Enkripsi End-to-End SSL/TLS</span>
            </div>
        </div>
    </section>

    <!-- Konten Utama -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Menu Navigasi -->
        <aside class="hidden lg:block lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm sticky top-24">
                <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wider mb-3">Ringkasan Privasi</h3>
                <nav class="space-y-1 text-xs">
                    <a href="#komitmen" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-sky-50 hover:text-sky-700 transition font-medium">1. Komitmen Perlindungan</a>
                    <a href="#data-dikumpulkan" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-sky-50 hover:text-sky-700 transition font-medium">2. Data yang Dikumpulkan</a>
                    <a href="#penggunaan" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-sky-50 hover:text-sky-700 transition font-medium">3. Tujuan Penggunaan</a>
                    <a href="#pihak-ketiga" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-sky-50 hover:text-sky-700 transition font-medium">4. Pembagian Pihak Ketiga</a>
                    <a href="#keamanan" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-sky-50 hover:text-sky-700 transition font-medium">5. Keamanan & Enkripsi</a>
                    <a href="#hak-pengguna" class="block px-3 py-2 rounded-lg text-gray-600 hover:bg-sky-50 hover:text-sky-700 transition font-medium">6. Hak-Hak Anda</a>
                </nav>

                <div class="mt-6 pt-5 border-t border-gray-100 text-xs text-gray-500">
                    <p class="mb-2">Pertanyaan tentang data pribadi?</p>
                    <a href="mailto:privacy@odaplace.test" class="text-sky-600 font-bold hover:underline inline-flex items-center gap-1">
                        privacy@odaplace.test
                    </a>
                </div>
            </div>
        </aside>

        <!-- Dokumen Privasi -->
        <div class="lg:col-span-3 space-y-8">
            <!-- 1. Komitmen -->
            <section id="komitmen" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-sm">01</span>
                    <h2 class="text-xl font-bold text-gray-900">Komitmen Perlindungan Privasi</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        Odaplace sangat menghargai privasi setiap individu yang mempercayakan data mereka kepada kami. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, serta menjaga kerahasiaan informasi identitas pribadi (PII) Anda saat berbelanja di website Odaplace.
                    </p>
                    <p>
                        Kami mematuhi seluruh perundang-undangan dan peraturan yang berlaku di Indonesia mengenai perlindungan data pribadi dan transaksi elektronik.
                    </p>
                </div>
            </section>

            <!-- 2. Data Dikumpulkan -->
            <section id="data-dikumpulkan" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-sm">02</span>
                    <h2 class="text-xl font-bold text-gray-900">Informasi yang Kami Kumpulkan</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mt-4">
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                            <i data-lucide="user-check" class="w-4 h-4 text-sky-600"></i> Data Identitas Akun
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Nama lengkap, alamat email, nomor telepon/WhatsApp, kata sandi terenkripsi, dan preferensi profil.
                        </p>
                    </div>

                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-sky-600"></i> Data Alamat & Pengiriman
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Alamat penerima, nomor rumah, kelurahan, kecamatan, kabupaten/kota, provinsi, kode pos, dan catatan kurir.
                        </p>
                    </div>

                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                            <i data-lucide="credit-card" class="w-4 h-4 text-sky-600"></i> Data Transaksi & Pembayaran
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Metode pembayaran yang dipilih, riwayat tagihan, nomor Virtual Account, dan status penyelesaian pesanan.
                        </p>
                    </div>

                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl">
                        <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                            <i data-lucide="laptop" class="w-4 h-4 text-sky-600"></i> Data Perangkat & Log
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            Alamat IP, tipe browser, histori pencarian dalam platform, dan cookie untuk menjaga sesi login.
                        </p>
                    </div>
                </div>
            </section>

            <!-- 3. Penggunaan Data -->
            <section id="penggunaan" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-sm">03</span>
                    <h2 class="text-xl font-bold text-gray-900">Bagaimana Kami Menggunakan Informasi Anda</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-2">
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Memproses Pesanan:</strong> Mengonfirmasi pesanan, memproses pembayaran aman, dan meneruskan alamat kepada kurir pengiriman.</li>
                        <li><strong>Layanan Pelanggan:</strong> Merespons pertanyaan komplain, melacak status pesanan, dan membantu proses refund.</li>
                        <li><strong>Peningkatan Pengalaman:</strong> Mengoptimalkan kecepatan aplikasi, menyajikan rekomendasi produk yang relevan, dan fitur Barang Terdekat.</li>
                        <li><strong>Pencegahan Penipuan:</strong> Memverifikasi keabsahan transaksi demi mencegah transaksi curang atau ilegal.</li>
                    </ul>
                </div>
            </section>

            <!-- 4. Pihak Ketiga -->
            <section id="pihak-ketiga" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-sm">04</span>
                    <h2 class="text-xl font-bold text-gray-900">Pembagian Data kepada Pihak Ketiga</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        <strong>Odaplace TIDAK AKAN PERNAH menjual atau menyewakan data pribadi Anda</strong> kepada pihak ketiga mana pun untuk tujuan periklanan tanpa izin eksplisit Anda.
                    </p>
                    <p>
                        Data hanya dibagikan secara terbatas kepada mitra esensial berikut:
                    </p>
                    <ul class="list-disc pl-5 space-y-1.5 text-xs text-gray-600">
                        <li><strong>Mitra Ekspedisi Logistik:</strong> (Nama, nomor telepon, dan alamat pengiriman diberikan kepada kurir seperti J&T, SiCepat, atau JNE untuk pengantaran paket).</li>
                        <li><strong>Penyedia Layanan Pembayaran Resmi:</strong> Untuk pemrosesan Virtual Account dan E-Wallet secara terenkripsi.</li>
                        <li><strong>Otoritas Hukum yang Berwenang:</strong> Apabila diwajibkan oleh putusan pengadilan atau peraturan perundangan resmi Republik Indonesia.</li>
                    </ul>
                </div>
            </section>

            <!-- 5. Keamanan -->
            <section id="keamanan" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-sm">05</span>
                    <h2 class="text-xl font-bold text-gray-900">Keamanan Data & Penyimpanan</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        Kami menerapkan standar teknis industri tertinggi untuk melindungi data Anda, termasuk protokol enkripsi SSL 256-bit, firewall multi-lapis, dan pembatasan akses internal yang ketat hanya kepada staf yang berwenang.
                    </p>
                </div>
            </section>

            <!-- 6. Hak Pengguna -->
            <section id="hak-pengguna" class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm scroll-mt-24">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-sm">06</span>
                    <h2 class="text-xl font-bold text-gray-900">Hak Anda sebagai Pemilik Data</h2>
                </div>
                <div class="text-sm text-gray-600 leading-relaxed space-y-3">
                    <p>
                        Sesuai undang-undang perlindungan data pribadi, Anda berhak untuk:
                    </p>
                    <ul class="list-disc pl-5 space-y-1.5">
                        <li>Mengakses dan memperbarui informasi profil akun Anda kapan saja melalui menu Pengaturan Profil.</li>
                        <li>Meminta penghapusan data akun atau riwayat personal Anda.</li>
                        <li>Menolak komunikasi promosi atau buletin pemasaran kami melalui tautan berhenti berlangganan.</li>
                    </ul>
                    <div class="mt-4 p-4 bg-sky-50 border border-sky-100 rounded-xl flex items-center justify-between text-xs text-sky-900">
                        <span>Ingin meminta salinan atau penghapusan data akun Anda?</span>
                        <a href="{{ route('contact') }}" class="font-bold text-sky-700 hover:underline">Ajukan Permintaan</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
