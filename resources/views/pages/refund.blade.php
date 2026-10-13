@extends('layouts.app')

@section('title', 'Kebijakan Refund & Pengembalian - Odaplace')

@section('content')
<div class="max-w-[1180px] mx-auto px-4 lg:px-8 py-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <span class="text-gray-900 font-medium">Kebijakan Refund</span>
    </nav>

    <!-- Hero Banner -->
    <section class="rounded-3xl bg-primary px-6 py-12 text-white shadow-lg sm:px-10 lg:px-14 lg:py-14 mb-10">
        <div class="max-w-2xl">
            <div class="mb-4 inline-flex items-center rounded-full border border-white/30 bg-white/15 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-white">
                Jaminan Belanja Tenang
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl text-white">Kebijakan Refund & Retur Barang</h1>
            <p class="mt-4 max-w-xl text-sm leading-relaxed text-white/90 sm:text-base">
                Garansi uang kembali atau penukaran barang jika produk yang kamu terima rusak, cacat produksi, atau tidak sesuai pesanan.
            </p>
            <div class="mt-6 flex flex-wrap items-center gap-4 text-xs text-orange-100/80">
                <span class="flex items-center gap-1.5"><i data-lucide="badge-check" class="w-4 h-4"></i> Garansi Komplain 2x24 Jam</span>
                <span>•</span>
                <span class="flex items-center gap-1.5"><i data-lucide="banknote" class="w-4 h-4"></i> Pengembalian Dana Cepat & Transparan</span>
            </div>
        </div>
    </section>

    <!-- 4 Langkah Alur Refund (Card Highlight) -->
    <section class="mb-12">
        <div class="mb-6">
            <span class="text-xs font-bold uppercase tracking-wider text-primary">Alur Mudah</span>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">4 Langkah Pengajuan Retur & Refund</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <span class="w-8 h-8 rounded-full bg-orange-100 text-primary flex items-center justify-center font-bold text-sm mb-3">1</span>
                <h3 class="font-bold text-gray-900 text-sm mb-1.5">Rekam Video Unboxing</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Rekam pembukaan paket sejak segel masih utuh memperlihatkan label resi pengiriman.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <span class="w-8 h-8 rounded-full bg-orange-100 text-primary flex items-center justify-center font-bold text-sm mb-3">2</span>
                <h3 class="font-bold text-gray-900 text-sm mb-1.5">Ajukan Klaim 2x24 Jam</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Hubungi CS kami melalui WhatsApp atau formulir kontak dengan mencantumkan No. Invoice.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <span class="w-8 h-8 rounded-full bg-orange-100 text-primary flex items-center justify-center font-bold text-sm mb-3">3</span>
                <h3 class="font-bold text-gray-900 text-sm mb-1.5">Kirim Balik Produk</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Kemas barang seperti semula bersama tag asli lalu kirimkan ke alamat gudang retur Odaplace.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <span class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm mb-3">4</span>
                <h3 class="font-bold text-gray-900 text-sm mb-1.5">Pencairan Dana</h3>
                <p class="text-xs text-gray-500 leading-relaxed">Setelah verifikasi barang lolos pengecekan tim QC, dana akan dikembalikan dalam 1-3 hari kerja.</p>
            </div>
        </div>
    </section>

    <!-- Rincian Kebijakan Detail -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <!-- Syarat Utama -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i data-lucide="check-check" class="w-5 h-5 text-green-600"></i>
                    Syarat & Ketentuan Pengembalian Barang
                </h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start gap-2.5">
                        <i data-lucide="circle-check" class="w-4 h-4 text-green-500 mt-0.5 shrink-0"></i>
                        <span>Pengajuan komplain dilakukan maksimal <strong>2x24 jam</strong> terhitung sejak paket dinyatakan "Diterima" oleh sistem kurir ekspedisi.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <i data-lucide="circle-check" class="w-4 h-4 text-green-500 mt-0.5 shrink-0"></i>
                        <span>Produk belum pernah digunakan untuk aktivitas di luar, belum dicuci, dan tidak berbau parfum atau deterjen.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <i data-lucide="circle-check" class="w-4 h-4 text-green-500 mt-0.5 shrink-0"></i>
                        <span>Hangtag, label merek, dan kemasan pembungkus asli masih utuh dan terpasang.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <i data-lucide="circle-check" class="w-4 h-4 text-green-500 mt-0.5 shrink-0"></i>
                        <span>Menyertakan video rekaman unboxing paket utuh tanpa jeda (cut/edit) untuk membuktikan kondisi riil produk.</span>
                    </li>
                </ul>
            </div>

            <!-- Alasan yang Diterima vs Ditolak -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Diterima -->
                <div class="bg-emerald-50/50 border border-emerald-200 rounded-2xl p-6 shadow-sm">
                    <h4 class="font-bold text-emerald-900 text-sm mb-3 flex items-center gap-2">
                        <i data-lucide="thumbs-up" class="w-4 h-4 text-emerald-600"></i> Alasan yang Diterima
                    </h4>
                    <ul class="space-y-2 text-xs text-emerald-800 leading-relaxed">
                        <li>• Barang rusak/cacat pabrik (sobek jahitan, resleting macet, noda membandel).</li>
                        <li>• Salah kirim varian ukuran, warna, atau model barang oleh penjual.</li>
                        <li>• Isi paket tidak lengkap atau kurang dari kuantitas pemesanan.</li>
                        <li>• Barang tidak sesuai dengan spesifikasi deskripsi produk secara signifikan.</li>
                    </ul>
                </div>

                <!-- Ditolak -->
                <div class="bg-rose-50/50 border border-rose-200 rounded-2xl p-6 shadow-sm">
                    <h4 class="font-bold text-rose-900 text-sm mb-3 flex items-center gap-2">
                        <i data-lucide="thumbs-down" class="w-4 h-4 text-rose-600"></i> Alasan yang Ditolak
                    </h4>
                    <ul class="space-y-2 text-xs text-rose-800 leading-relaxed">
                        <li>• Pembeli berubah pikiran atau salah memilih ukuran padahal panduan ukuran telah tertera jelas.</li>
                        <li>• Kerusakan akibat kelalaian pembeli saat membuka paket dengan benda tajam.</li>
                        <li>• Produk kategori intim/underwear (demi standar higienitas & kesehatan).</li>
                        <li>• Komplain diajukan melewati batas waktu 2x24 jam sejak paket diterima.</li>
                    </ul>
                </div>
            </div>

            <!-- Estimasi Pengembalian Dana -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i data-lucide="wallet-cards" class="w-5 h-5 text-primary"></i>
                    Metode & Estimasi Waktu Pencairan Refund
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 text-xs font-bold uppercase tracking-wider">
                            <tr>
                                <th class="p-3 rounded-l-lg">Metode Pembayaran Asli</th>
                                <th class="p-3">Tujuan Refund</th>
                                <th class="p-3 rounded-r-lg">Estimasi Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs">
                            <tr>
                                <td class="p-3 font-medium text-gray-900">Transfer Bank / Virtual Account</td>
                                <td class="p-3">Rekening Bank Pembeli</td>
                                <td class="p-3 text-primary font-bold">1 – 3 Hari Kerja</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-medium text-gray-900">E-Wallet (GoPay, OVO, DANA)</td>
                                <td class="p-3">Saldo E-Wallet / Saldo Akun</td>
                                <td class="p-3 text-primary font-bold">1x24 Jam (Instan)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-medium text-gray-900">COD (Bayar di Tempat)</td>
                                <td class="p-3">Transfer Rekening Bank</td>
                                <td class="p-3 text-primary font-bold">1 – 2 Hari Kerja</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Bantuan & Tombol Aksi -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm sticky top-24">
                <div class="w-12 h-12 rounded-xl bg-orange-100 text-primary flex items-center justify-center font-bold mb-4">
                    <i data-lucide="headset" class="w-6 h-6"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Ingin Mengajukan Refund?</h3>
                <p class="text-xs text-gray-500 leading-relaxed mb-6">
                    Tim penyelesaian kendala Odaplace siap membantu proses retur kamu dengan cepat dan ramah.
                </p>

                <div class="space-y-3">
                    <a href="{{ route('contact') }}" class="w-full block text-center bg-primary hover:bg-primary-hover text-white font-bold py-3 px-4 rounded-xl text-xs transition-colors shadow-md shadow-orange-500/20">
                        Ajukan Komplain Pesanan
                    </a>
                    <a href="{{ route('account.orders') }}" class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-4 rounded-xl text-xs transition-colors">
                        Lihat Nomor Invoice Pesanan
                    </a>
                </div>

                <div class="mt-6 pt-5 border-t border-gray-100">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Jam Operasional Layanan</span>
                    <p class="text-xs text-gray-700 font-medium">Senin – Minggu: 08.00 – 21.00 WIB</p>
                    <p class="text-xs text-gray-400 mt-0.5">Respon rata-rata: &lt; 15 menit</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
