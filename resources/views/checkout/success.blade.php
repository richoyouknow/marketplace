@extends('layouts.app')

@section('title', 'Pesanan Berhasil - ALLWEAR FASHION')

@section('content')
<div class="max-w-3xl mx-auto px-4 lg:px-8 py-8">
    <div class="bg-white rounded-2xl border border-gray-200 p-8 md:p-12 text-center flex flex-col items-center justify-center shadow-sm">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-5 text-green-600 animate-bounce">
            <i data-lucide="check-circle-2" class="w-10 h-10"></i>
        </div>
        
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Pesanan Berhasil Dibuat!</h1>
        <p class="text-gray-500 max-w-md mx-auto mb-6 text-sm md:text-base">Terima kasih atas pesanan Anda. Kami sedang memproses pesanan ini untuk segera dikirimkan ke alamat Anda.</p>
        
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 w-full max-w-lg mb-6 text-left">
            <div class="flex items-center justify-between border-b border-gray-200 pb-3 mb-3">
                <span class="text-xs text-gray-500 font-medium">Nomor Pesanan</span>
                <span class="font-mono font-bold text-sm text-gray-900 tracking-wide">{{ $orderId }}</span>
            </div>
            @if(isset($order['invoice_number']))
            <div class="flex items-center justify-between border-b border-gray-200 pb-3 mb-3">
                <span class="text-xs text-gray-500 font-medium">Nomor Invoice</span>
                <span class="font-mono text-xs font-semibold text-gray-700">{{ $order['invoice_number'] }}</span>
            </div>
            @endif
            @if(isset($order['payment']['name']))
            <div class="flex items-center justify-between border-b border-gray-200 pb-3 mb-3">
                <span class="text-xs text-gray-500 font-medium">Metode Pembayaran</span>
                <span class="text-xs font-semibold text-gray-900">{{ $order['payment']['name'] }}</span>
            </div>
            @endif
            @if(isset($order['pricing']['total']))
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-500 font-medium">Total Pembayaran</span>
                <span class="font-bold text-base text-primary">Rp {{ number_format($order['pricing']['total'], 0, ',', '.') }}</span>
            </div>
            @endif
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3 justify-center w-full max-w-lg">
            <a href="{{ route('checkout.order', $orderId) }}" class="flex-1 bg-primary hover:bg-primary-hover text-white py-3.5 px-6 rounded-xl font-bold text-center transition-colors shadow-md shadow-orange-500/20 text-sm flex items-center justify-center gap-2">
                <i data-lucide="receipt-text" class="w-4 h-4"></i> Lihat Detail Pesanan
            </a>
            <a href="{{ route('home') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 py-3.5 px-6 rounded-xl font-bold text-center transition-colors text-sm">
                Lanjut Belanja
            </a>
        </div>
    </div>
</div>
@endsection

