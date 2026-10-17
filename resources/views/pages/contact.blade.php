@extends('layouts.app')

@section('title', 'Kontak Kami - ALLWEAR FASHION')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 lg:px-8 py-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <span class="text-gray-900 font-medium">Kontak Kami</span>
    </nav>

    <!-- Hero Banner -->
    <section class="rounded-3xl bg-primary px-6 py-12 text-white shadow-lg sm:px-10 lg:px-14 lg:py-14 mb-10">
        <div class="max-w-2xl">
            <div class="mb-4 inline-flex items-center rounded-full border border-white/30 bg-white/15 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-white">
                Layanan Bantuan Pelanggan
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl text-white">Hubungi Tim ALLWEAR FASHION</h1>
            <p class="mt-4 max-w-xl text-sm leading-relaxed text-white/90 sm:text-base">
                Ada pertanyaan tentang produk, konfirmasi pesanan, atau kendala pengiriman? Tim kami siap mendengarkan dan membantu Anda setiap hari.
            </p>
        </div>
    </section>

    <!-- Grid Kontak -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Informasi Kontak & Jam Kerja -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Kartu Saluran Bantuan -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-primary">Informasi Resmi</span>
                    <h2 class="text-lg font-bold text-gray-900 mt-0.5">Saluran Bantuan</h2>
                </div>

                <div class="space-y-4 text-sm">
                    <!-- WhatsApp / Telepon -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center shrink-0">
                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block">WhatsApp / Telepon</span>
                            <a href="https://wa.me/6288991682058" target="_blank" rel="noopener noreferrer" class="font-bold text-gray-900 hover:text-primary transition-colors">
                                088991682058
                            </a>
                            <span class="text-[11px] text-green-600 block mt-0.5 font-medium flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-green-500 inline-block animate-pulse"></span> Online & Responsif
                            </span>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center shrink-0">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block">Email Dukungan</span>
                            <a href="mailto:allawearindfashion@gmail.com" class="font-bold text-gray-900 hover:text-primary transition-colors break-all">
                                allawearindfashion@gmail.com
                            </a>
                        </div>
                    </div>

                    <!-- Alamat Kantor -->
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-primary flex items-center justify-center shrink-0">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block">Kantor & Workshop Operasional</span>
                            <p class="font-bold text-gray-900">ALLWEAR FASHION</p>
                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                KP. SETU 2, Desa/Kelurahan Situ Udik, Kec. Cinungbulang, Kab. Bogor, Provinsi Jawa Barat Kode Pos: 16630
                            </p>
                            <div class="mt-2 inline-flex items-center gap-1 text-[11px] font-semibold text-primary bg-orange-50 px-2 py-0.5 rounded-md">
                                <i data-lucide="calendar" class="w-3 h-3"></i> Usaha Mikro berjalan sejak: September 2026
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="pt-5 border-t border-gray-100">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Jam Operasional Tim CS</span>
                    <div class="text-xs space-y-1.5 text-gray-600">
                        <div class="flex justify-between">
                            <span>Senin – Jumat:</span>
                            <span class="font-bold text-gray-900">08.00 – 21.00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sabtu – Minggu / Libur:</span>
                            <span class="font-bold text-gray-900">09.00 – 18.00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Akses Cepat Bantuan -->
            <div class="bg-orange-50/60 border border-orange-100 rounded-2xl p-6 text-xs text-orange-900">
                <div class="flex items-center gap-2 font-bold text-sm mb-2 text-orange-950">
                    <i data-lucide="help-circle" class="w-4 h-4 text-primary"></i> Pertanyaan Sering Diajukan?
                </div>
                <p class="text-orange-800/80 leading-relaxed mb-3">
                    Kamu mungkin menemukan jawaban instan atas pesanan atau pengirimanmu di Pusat Bantuan kami.
                </p>
                <div class="flex flex-col gap-2 font-bold">
                    <a href="{{ route('help') }}" class="text-primary hover:underline flex items-center gap-1">
                        Buka Pusat Bantuan (FAQ) <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                    <a href="{{ route('refund') }}" class="text-primary hover:underline flex items-center gap-1">
                        Panduan Kebijakan Refund <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Formulir Kirim Pesan -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 md:p-8 shadow-sm">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Kirim Pesan ke Tim Kami</h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">
                        Isi formulir di bawah ini dan perwakilan customer relation kami akan membalas secepat mungkin.
                    </p>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nama Lengkap -->
                        <div class="space-y-1.5">
                            <label for="name" class="block text-xs font-bold text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Contoh: Rian Pratama">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label for="email" class="block text-xs font-bold text-gray-700">Alamat Email <span class="text-red-500">*</span></label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="nama@email.com">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- No HP / WhatsApp -->
                        <div class="space-y-1.5">
                            <label for="phone" class="block text-xs font-bold text-gray-700">No. WhatsApp / HP <span class="font-normal text-gray-400">(opsional)</span></label>
                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="088991682058">
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Topik / Kategori Pesan -->
                        <div class="space-y-1.5">
                            <label for="subject" class="block text-xs font-bold text-gray-700">Topik Pesan <span class="text-red-500">*</span></label>
                            <select id="subject" name="subject" required class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Pilih kategori topik...</option>
                                <option value="Pertanyaan Pesanan & Pengiriman" {{ old('subject') === 'Pertanyaan Pesanan & Pengiriman' ? 'selected' : '' }}>Pertanyaan Pesanan & Pengiriman</option>
                                <option value="Pengajuan Retur atau Refund" {{ old('subject') === 'Pengajuan Retur atau Refund' ? 'selected' : '' }}>Pengajuan Retur atau Refund</option>
                                <option value="Kendala Pembayaran / Virtual Account" {{ old('subject') === 'Kendala Pembayaran / Virtual Account' ? 'selected' : '' }}>Kendala Pembayaran / Virtual Account</option>
                                <option value="Kemitraan Penjual / Merchant" {{ old('subject') === 'Kemitraan Penjual / Merchant' ? 'selected' : '' }}>Kemitraan Penjual / Merchant</option>
                                <option value="Kritik & Saran Lainnya" {{ old('subject') === 'Kritik & Saran Lainnya' ? 'selected' : '' }}>Kritik & Saran Lainnya</option>
                            </select>
                            @error('subject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div class="space-y-1.5">
                        <label for="message" class="block text-xs font-bold text-gray-700">Isi Pesan <span class="text-red-500">*</span></label>
                        <textarea id="message" name="message" required rows="5" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Tuliskan detail pertanyaan atau kendala Anda di sini...">{{ old('message') }}</textarea>
                        @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-primary hover:bg-primary-hover text-white font-bold rounded-xl text-sm transition-colors shadow-md shadow-orange-500/20 flex items-center justify-center gap-2">
                        <i data-lucide="send" class="w-4 h-4"></i> Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
