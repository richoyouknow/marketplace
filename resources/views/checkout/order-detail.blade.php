@extends('layouts.app')

@section('title', 'Detail Pesanan ' . $order['invoice_number'] . ' - ALLWEAR FASHION')

@section('content')
<div class="max-w-[1280px] mx-auto px-4 lg:px-8 py-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <a href="{{ route('account.orders') }}" class="hover:text-primary transition-colors">Pesanan Saya</a>
        <i data-lucide="chevron-right" class="w-4 h-4"></i>
        <span class="text-gray-900 font-medium">Detail Pesanan</span>
    </nav>

    <!-- Header Transaksi -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 md:p-8 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100 pb-6 mb-6">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-2">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Detail Pesanan</h1>
                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $order['badge_class'] ?? 'bg-amber-50 text-amber-700 border-amber-200' }}">
                        {{ $order['status'] }}
                    </span>
                </div>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-500">
                    <span class="flex items-center gap-1.5 font-mono text-gray-700 font-medium">
                        No. Invoice: <span id="invoiceText">{{ $order['invoice_number'] }}</span>
                        <button type="button" onclick="navigator.clipboard.writeText('{{ $order['invoice_number'] }}'); alert('Nomor invoice berhasil disalin!');" title="Salin Invoice" class="p-1 hover:text-primary transition-colors">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                        </button>
                    </span>
                    <span>•</span>
                    <span>Waktu Pemesanan: <strong class="text-gray-700 font-medium">{{ $order['created_at'] }}</strong></span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" onclick="window.print()" class="px-4 py-2.5 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 font-medium text-sm flex items-center gap-2 transition-colors">
                    <i data-lucide="printer" class="w-4 h-4"></i> Cetak Bukti
                </button>
                <a href="{{ route('products.index') }}" class="px-4 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white font-medium text-sm flex items-center gap-2 transition-colors shadow-sm shadow-orange-500/20">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i> Beli Lagi
                </a>
            </div>
        </div>

        <!-- Stepper Status Pesanan Khas Marketplace -->
        <div class="py-2">
            <h2 class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-6">Status Progres Pesanan</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 relative">
                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center">
                    <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold mb-2 shadow-sm">
                        <i data-lucide="check" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-900">Pesanan Dibuat</span>
                    <span class="text-[11px] text-gray-400 mt-0.5">{{ $order['created_at'] }}</span>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center">
                    <div class="w-10 h-10 rounded-full {{ ($order['payment']['status'] ?? '') === 'Sudah Dibayar' || ($order['payment']['method'] ?? '') === 'cod' ? 'bg-green-500 text-white' : 'bg-primary text-white animate-pulse' }} flex items-center justify-center font-bold mb-2 shadow-sm">
                        @if(($order['payment']['status'] ?? '') === 'Sudah Dibayar' || ($order['payment']['method'] ?? '') === 'cod')
                            <i data-lucide="check" class="w-5 h-5"></i>
                        @else
                            <i data-lucide="wallet" class="w-5 h-5"></i>
                        @endif
                    </div>
                    <span class="text-xs font-bold text-gray-900">
                        {{ ($order['payment']['method'] ?? '') === 'cod' ? 'Verifikasi COD' : 'Pembayaran' }}
                    </span>
                    <span class="text-[11px] text-gray-500 mt-0.5">
                        {{ ($order['payment']['status'] ?? '') === 'Sudah Dibayar' ? 'Terverifikasi' : 'Menunggu Bayar' }}
                    </span>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center">
                    <div class="w-10 h-10 rounded-full bg-orange-100 text-primary flex items-center justify-center font-bold mb-2">
                        <i data-lucide="package" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-900">Diproses ALLWEAR</span>
                    <span class="text-[11px] text-gray-500 mt-0.5">Sedang dikemas</span>
                </div>

                <!-- Step 4 -->
                <div class="flex flex-col items-center text-center">
                    <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold mb-2">
                        <i data-lucide="truck" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-500">Dalam Pengiriman</span>
                    <span class="text-[11px] text-gray-400 mt-0.5">{{ $order['shipping']['courier'] ?? 'Kurir' }}</span>
                </div>

                <!-- Step 5 -->
                <div class="flex flex-col items-center text-center col-span-2 md:col-span-1">
                    <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold mb-2">
                        <i data-lucide="map-pin-check" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-500">Pesanan Tiba</span>
                    <span class="text-[11px] text-gray-400 mt-0.5">Estimasi {{ $order['shipping']['etd'] ?? '2-3 hari' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Pengiriman & Produk -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Pengiriman -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 md:p-7 shadow-sm">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                    <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <i data-lucide="truck" class="w-5 h-5 text-primary"></i>
                        Informasi Pengiriman
                    </h2>
                    <span class="text-xs font-medium px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md">
                        Layanan {{ $order['shipping']['method'] ?? 'Reguler' }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-1">Kurir & No. Resi</span>
                        <p class="font-bold text-gray-900 text-sm mb-1">{{ $order['shipping']['courier'] ?? 'J&T Express' }}</p>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-mono font-medium bg-gray-100 px-2 py-1 rounded text-gray-800 tracking-wider">
                                {{ $order['shipping']['tracking_number'] ?? 'JP1234567890' }}
                            </span>
                            <button type="button" onclick="navigator.clipboard.writeText('{{ $order['shipping']['tracking_number'] ?? '' }}'); alert('No. Resi berhasil disalin!');" class="text-xs text-primary hover:underline flex items-center gap-1 font-medium">
                                <i data-lucide="copy" class="w-3.5 h-3.5"></i> Salin Resi
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Estimasi tiba: <strong class="text-gray-700">{{ $order['shipping']['etd'] ?? '2–5 hari kerja' }}</strong>
                        </p>
                    </div>

                    <div class="border-t md:border-t-0 md:border-l border-gray-100 md:pl-6 pt-4 md:pt-0">
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-1">Alamat Penerima</span>
                        <p class="font-bold text-gray-900 text-sm">
                            {{ $order['recipient']['name'] }}
                            <span class="text-gray-500 font-normal">({{ $order['recipient']['phone'] }})</span>
                        </p>
                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                            {{ $order['recipient']['address'] }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Kel. {{ $order['recipient']['kelurahan'] ?? '-' }}, Kec. {{ $order['recipient']['district'] }}, {{ $order['recipient']['city'] }}, {{ $order['recipient']['province'] }} {{ $order['recipient']['postal_code'] }}
                        </p>
                        @if(!empty($order['recipient']['notes']))
                        <div class="mt-3 p-2.5 bg-orange-50/60 border border-orange-100 rounded-lg text-xs text-orange-800 flex items-start gap-1.5">
                            <i data-lucide="sticky-note" class="w-3.5 h-3.5 mt-0.5 shrink-0 text-primary"></i>
                            <span><strong>Catatan Kurir:</strong> {{ $order['recipient']['notes'] }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mt-5 p-3.5 bg-gray-50 rounded-xl flex items-center gap-3 text-xs text-gray-600">
                    <i data-lucide="info" class="w-4 h-4 text-primary shrink-0"></i>
                    <span>{{ $order['shipping']['status_tracking'] ?? 'Paket sedang disiapkan tim ALLWEAR untuk dikirimkan ke mitra ekspedisi.' }}</span>
                </div>
            </div>

            <!-- Daftar Produk -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 md:p-7 shadow-sm">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-4">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 bg-primary/10 text-primary text-[11px] font-bold rounded">Official Store</span>
                        <h2 class="text-base font-bold text-gray-900">ALLWEAR FASHION Official</h2>
                    </div>
                    <span class="text-xs text-gray-500">{{ count($order['items'] ?? []) }} Produk</span>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach($order['items'] as $item)
                    <div class="py-4 first:pt-0 last:pb-0 flex items-start gap-4">
                        <div class="w-20 h-20 rounded-xl border border-gray-200 overflow-hidden shrink-0 bg-gray-50">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-2">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm hover:text-primary transition-colors line-clamp-2">
                                        @if(!empty($item['slug']))
                                            <a href="{{ route('products.show', $item['slug']) }}">{{ $item['name'] }}</a>
                                        @else
                                            {{ $item['name'] }}
                                        @endif
                                    </h3>
                                    <span class="text-xs text-primary font-semibold mt-0.5 block">Koleksi Resmi ALLWEAR</span>
                                    @if(!empty($item['size']))
                                    <span class="inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded font-bold bg-orange-50 text-orange-800 border border-orange-200 mt-1">
                                        <i data-lucide="ruler" class="w-3 h-3 text-primary"></i> Ukuran: {{ $item['size'] }}
                                    </span>
                                    @endif
                                    <span class="text-xs text-gray-500 mt-1 block">
                                        {{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="text-right sm:shrink-0">
                                    <span class="font-bold text-gray-900 text-base">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Rincian Pembayaran -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Box Pembayaran -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 md:p-7 shadow-sm sticky top-24">
                <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-4 mb-5 flex items-center gap-2">
                    <i data-lucide="receipt" class="w-5 h-5 text-primary"></i>
                    Rincian Pembayaran
                </h2>

                <!-- Status Pembayaran & Virtual Account -->
                @if(!empty($order['payment']['code']))
                <div class="bg-orange-50/50 border border-orange-200 rounded-xl p-4 mb-5">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold text-gray-700">{{ $order['payment']['name'] }}</span>
                        <span class="text-[11px] font-bold text-primary px-2 py-0.5 bg-orange-100 rounded">
                            {{ $order['payment']['status'] ?? 'Menunggu Bayar' }}
                        </span>
                    </div>
                    <span class="text-[11px] text-gray-500 block mb-1">Nomor Rekening / Virtual Account:</span>
                    <div class="flex items-center justify-between bg-white border border-orange-200 rounded-lg p-2.5">
                        <span class="font-mono font-bold text-gray-900 text-base tracking-wider">{{ $order['payment']['code'] }}</span>
                        <button type="button" onclick="navigator.clipboard.writeText('{{ $order['payment']['code'] }}'); alert('Nomor Virtual Account disalin!');" class="text-xs font-bold text-primary hover:text-primary-hover flex items-center gap-1">
                            <i data-lucide="copy" class="w-3.5 h-3.5"></i> Salin
                        </button>
                    </div>
                    @if(!empty($order['deadline']))
                    <p class="text-[11px] text-gray-500 mt-2 flex items-center gap-1">
                        <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-500"></i>
                        Batas bayar: <strong class="text-gray-700">{{ $order['deadline'] }}</strong>
                    </p>
                    @endif
                </div>
                @else
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mb-5">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-bold text-gray-900">{{ $order['payment']['name'] }}</span>
                        <span class="text-[11px] font-bold text-blue-700 bg-blue-100 px-2 py-0.5 rounded">
                            {{ $order['payment']['status'] }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500">{{ $order['payment']['instructions'] }}</p>
                </div>
                @endif

                <!-- Rincian Biaya -->
                <div class="space-y-3 text-sm border-b border-gray-100 pb-5 mb-5">
                    <div class="flex justify-between text-gray-600">
                        <span>Total Harga ({{ count($order['items'] ?? []) }} Barang)</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($order['pricing']['subtotal'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Total Ongkos Kirim</span>
                        @if(($order['pricing']['shipping_fee'] ?? 0) == 0)
                            <span class="font-medium text-green-600">Gratis</span>
                        @else
                            <span class="font-medium text-gray-900">Rp {{ number_format($order['pricing']['shipping_fee'], 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Biaya Layanan</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($order['pricing']['service_fee'] ?? 1000, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Total Tagihan -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="font-bold text-gray-900 text-base block">Total Belanja</span>
                        <span class="text-xs text-gray-400">Termasuk PPN</span>
                    </div>
                    <span class="font-bold text-primary text-2xl">
                        Rp {{ number_format($order['pricing']['total'], 0, ',', '.') }}
                    </span>
                </div>

                <!-- Navigasi Bawah -->
                <div class="space-y-2.5">
                    <a href="{{ route('account.orders') }}" class="w-full block text-center bg-gray-900 hover:bg-black text-white font-bold py-3.5 rounded-xl transition-colors text-sm shadow-md shadow-gray-900/10">
                        Lihat Riwayat Pesanan
                    </a>
                    <a href="{{ route('home') }}" class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 rounded-xl transition-colors text-sm">
                        Kembali Belanja
                    </a>
                </div>

                <!-- Card Bantuan -->
                <div class="mt-6 pt-5 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="shield-check" class="w-4 h-4 text-green-600"></i>
                        Transaksi Aman & Terlindungi
                    </span>
                    <a href="{{ route('help') }}" class="text-primary hover:underline font-medium">Bantuan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
