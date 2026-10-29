@extends('layouts.app')

@section('title', 'Pusat Bantuan - ALLWEAR FASHION')

@section('content')
<div class="max-w-[1180px] mx-auto px-4 lg:px-8" x-data="{ openFaq: 0 }">
    <section class="rounded-3xl bg-primary px-6 py-12 text-white shadow-lg sm:px-10 lg:px-16 lg:py-16">
        <div class="max-w-2xl">
            <div class="mb-5 inline-flex items-center rounded-full border border-white/30 bg-white/15 px-3.5 py-1.5 text-xs font-semibold uppercase tracking-[0.18em] text-white">Pusat bantuan ALLWEAR FASHION</div>
            <h1 class="text-3xl font-bold tracking-tight sm:text-5xl text-white">Ada yang bisa kami bantu?</h1>
            <p class="mt-4 max-w-xl text-sm leading-7 text-white/90 sm:text-base">Temukan jawaban untuk pertanyaan tentang pesanan, pembayaran, pengiriman, dan pengalaman belanja kamu di ALLWEAR FASHION.</p>
            <form action="{{ route('help') }}" method="GET" class="mt-8 flex max-w-xl items-center gap-2 rounded-2xl bg-white p-2 shadow-lg">
                <i data-lucide="search" class="ml-3 h-5 w-5 shrink-0 text-gray-400"></i>
                <label for="helpSearch" class="sr-only">Cari bantuan</label>
                <input id="helpSearch" name="q" value="{{ request('q') }}" class="min-w-0 flex-1 border-0 bg-transparent px-2 py-3 text-sm text-gray-800 outline-none" placeholder="Cari topik bantuan...">
                <button type="submit" class="rounded-xl bg-gray-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-black">Cari</button>
            </form>
        </div>
    </section>

    <section class="relative z-10 -mt-7 grid gap-4 sm:grid-cols-3">
        <a href="#faq" class="rounded-2xl border border-gray-100 bg-white p-5 shadow-lg transition hover:-translate-y-1 hover:border-orange-200"><span class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-primary"><i data-lucide="circle-help" class="h-5 w-5"></i></span><h2 class="font-bold text-gray-900">FAQ populer</h2><p class="mt-1 text-sm text-gray-500">Jawaban cepat untuk pertanyaan umum.</p></a>
        <a href="#panduan" class="rounded-2xl border border-gray-100 bg-white p-5 shadow-lg transition hover:-translate-y-1 hover:border-orange-200"><span class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-primary"><i data-lucide="book-open" class="h-5 w-5"></i></span><h2 class="font-bold text-gray-900">Panduan belanja</h2><p class="mt-1 text-sm text-gray-500">Ikuti langkah belanja dengan mudah.</p></a>
        <a href="mailto:allawearindfashion@gmail.com" class="rounded-2xl border border-gray-100 bg-white p-5 shadow-lg transition hover:-translate-y-1 hover:border-orange-200"><span class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-primary"><i data-lucide="message-circle" class="h-5 w-5"></i></span><h2 class="font-bold text-gray-900">Hubungi kami</h2><p class="mt-1 text-sm text-gray-500">Tim kami siap membantu kamu.</p></a>
    </section>

    @php
        $faqs = [
            ['Bagaimana cara melakukan pemesanan?', 'Pilih produk, tekan Tambah ke Keranjang, buka keranjang, lalu lanjutkan ke checkout. Isi alamat pengiriman, pilih pembayaran, dan konfirmasi pesanan.'],
            ['Apakah saya bisa melacak pesanan?', 'Bisa. Setelah pesanan diproses, informasi pengiriman dan nomor resi tersedia di halaman Pesanan pada akun kamu.'],
            ['Bagaimana cara menggunakan fitur Barang Terdekat?', 'Buka menu Barang Terdekat, pilih Gunakan lokasi saya, dan izinkan akses lokasi di browser. Koleksi produk ALLWEAR akan diurutkan berdasarkan estimasi rute pengiriman terdekat ke alamat kamu.'],
            ['Apakah produk bisa dikembalikan?', 'Jika produk rusak atau tidak sesuai pesanan, hubungi kami maksimal 2 x 24 jam setelah paket diterima dengan menyertakan foto dan detail pesanan.'],
            ['Metode pembayaran apa saja yang tersedia?', 'ALLWEAR FASHION mendukung transfer bank, e-wallet, dan metode pembayaran lain yang tersedia pada halaman checkout.'],
        ];
        $query = strtolower(trim((string) request('q')));
        $visibleFaqs = $query ? array_filter($faqs, fn ($faq) => str_contains(strtolower($faq[0] . ' ' . $faq[1]), $query)) : $faqs;
    @endphp

    <section id="faq" class="mt-16 scroll-mt-24">
        <div class="mb-6"><p class="text-sm font-bold uppercase tracking-[0.16em] text-primary">Pertanyaan umum</p><h2 class="mt-2 text-2xl font-bold text-gray-900">Jawaban yang paling sering dicari</h2></div>
        <div class="space-y-3">
            @forelse($visibleFaqs as $index => $faq)
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:border-orange-200">
                    <button type="button" id="faq-question-{{ $index }}" @click="openFaq = openFaq === {{ $index }} ? -1 : {{ $index }}" class="flex w-full items-center justify-between gap-4 p-5 text-left font-semibold text-gray-900"><span>{{ $faq[0] }}</span><i data-lucide="chevron-down" class="h-5 w-5 shrink-0 text-primary transition-transform" :class="openFaq === {{ $index }} ? 'rotate-180' : ''"></i></button>
                    <div x-show="openFaq === {{ $index }}" x-collapse class="px-5 pb-5 text-sm leading-7 text-gray-600">{{ $faq[1] }}</div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-10 text-center"><i data-lucide="search-x" class="mx-auto h-8 w-8 text-gray-400"></i><p class="mt-3 font-semibold text-gray-900">Topik bantuan tidak ditemukan</p><p class="mt-1 text-sm text-gray-500">Coba gunakan kata kunci lain atau hubungi tim kami.</p></div>
            @endforelse
        </div>
    </section>

    <section id="panduan" class="mt-16 scroll-mt-24">
        <div class="mb-6"><p class="text-sm font-bold uppercase tracking-[0.16em] text-primary">Mulai belanja</p><h2 class="mt-2 text-2xl font-bold text-gray-900">Belanja dalam tiga langkah</h2></div>
        <div class="grid gap-4 md:grid-cols-3">
            @foreach([['01', 'Temukan produk', 'Jelajahi kategori atau gunakan pencarian untuk menemukan produk favoritmu.'], ['02', 'Periksa detail', 'Lihat deskripsi, spesifikasi, pilihan ukuran, rating, dan ketersediaan stok sebelum membeli.'], ['03', 'Checkout aman', 'Masukkan alamat, pilih pembayaran, lalu pantau pesanan sampai tiba.']] as $step)
                <div class="rounded-2xl border border-gray-200 bg-white p-6"><span class="text-3xl font-black text-orange-100">{{ $step[0] }}</span><h3 class="mt-4 font-bold text-gray-900">{{ $step[1] }}</h3><p class="mt-2 text-sm leading-6 text-gray-500">{{ $step[2] }}</p></div>
            @endforeach
        </div>
    </section>

    <section class="mt-16 rounded-2xl bg-gray-900 px-6 py-8 text-white sm:flex sm:items-center sm:justify-between sm:px-8"><div><h2 class="text-xl font-bold">Masih membutuhkan bantuan?</h2><p class="mt-1 text-sm text-gray-400">Kirim pertanyaanmu dan tim ALLWEAR FASHION akan membantu.</p></div><a href="mailto:allawearindfashion@gmail.com" class="mt-5 inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-bold transition hover:bg-primary-hover sm:mt-0"><i data-lucide="mail" class="h-4 w-4"></i>Email dukungan</a></section>
</div>
@endsection