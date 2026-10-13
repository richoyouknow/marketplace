@extends('layouts.app')
@section('title', 'Riwayat Pesanan - Odaplace')
@section('content')
<div class="max-w-[1280px] mx-auto px-4 lg:px-8 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <aside class="bg-white border border-gray-200 rounded-2xl p-5 h-fit shadow-sm">
            <h2 class="font-bold text-gray-900 px-3 mb-3 text-base">Akun Saya</h2>
            <nav class="space-y-1 text-sm font-medium">
                <a href="{{ route('account.profile') }}" class="block px-3 py-2.5 rounded-xl text-gray-600 hover:bg-gray-50 transition-colors">Pengaturan Profil</a>
                <a href="{{ route('account.orders') }}" class="block px-3 py-2.5 rounded-xl bg-orange-50 text-primary font-bold">Riwayat Pesanan</a>
                <a href="{{ route('wishlist.index') }}" class="block px-3 py-2.5 rounded-xl text-gray-600 hover:bg-gray-50 transition-colors">Wishlist Saya</a>
            </nav>
        </aside>

        <section class="lg:col-span-3">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Riwayat Pesanan</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola dan pantau semua pesanan belanja Anda di Odaplace.</p>
                </div>
            </div>

            @if(empty($orders))
            <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center shadow-sm">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <i data-lucide="package-x" class="w-8 h-8"></i>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-1">Belum Ada Pesanan</h3>
                <p class="text-gray-500 text-sm mb-6">Anda belum pernah melakukan pemesanan barang.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-hover text-white px-6 py-3 rounded-xl font-bold text-sm transition-colors shadow-md shadow-orange-500/20">
                    Mulai Belanja Sekarang
                </a>
            </div>
            @else
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-gray-300 transition-colors">
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 pb-4 mb-4">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="font-mono font-bold text-sm text-gray-900">{{ $order['invoice_number'] ?? $order['id'] }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-500">{{ $order['created_at'] }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $order['badge_class'] ?? 'bg-blue-50 text-blue-700 border-blue-200' }}">
                            {{ $order['status'] }}
                        </span>
                    </div>

                    @if(!empty($order['items']))
                    <div class="space-y-3 mb-4">
                        @foreach(array_slice($order['items'], 0, 2) as $item)
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-lg border border-gray-200 overflow-hidden shrink-0 bg-gray-50">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-sm text-gray-900 truncate">{{ $item['name'] }}</h4>
                                <span class="text-xs text-gray-500 block mt-0.5">
                                    {{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        @endforeach

                        @if(count($order['items']) > 2)
                        <p class="text-xs text-gray-400 italic">+ {{ count($order['items']) - 2 }} produk lainnya</p>
                        @endif
                    </div>
                    @endif

                    <div class="flex flex-wrap items-center justify-between gap-4 pt-3 border-t border-gray-100">
                        <div>
                            <span class="text-xs text-gray-500 block">Total Belanja</span>
                            <span class="font-bold text-lg text-primary">
                                Rp {{ number_format($order['pricing']['total'] ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('checkout.order', $order['id']) }}" class="px-5 py-2.5 rounded-xl bg-gray-900 hover:bg-black text-white text-xs font-bold transition-colors shadow-sm">
                                Lihat Detail Pesanan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </section>
    </div>
</div>
@endsection
