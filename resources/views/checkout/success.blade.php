@extends('layouts.app')

@section('title', 'Order Success - Odaplace')

@section('content')
<div class="max-w-3xl mx-auto px-4 lg:px-8">
    <div class="bg-white rounded-xl border border-gray-200 p-8 md:p-16 text-center flex flex-col items-center justify-center mt-8">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mb-6 text-green-500">
            <i data-lucide="check-circle" class="w-12 h-12"></i>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Pesanan Berhasil Dibuat!</h1>
        <p class="text-gray-500 max-w-md mx-auto mb-8 text-lg">Thank you for your purchase. Your order has been received and is being processed.</p>
        
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 w-full max-w-md mb-8">
            <span class="text-sm text-gray-500 block mb-1">Order Number</span>
            <span class="font-bold text-xl text-gray-900 tracking-wide">{{ $orderId }}</span>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center w-full max-w-md">
            <a href="{{ route('home') }}" class="flex-1 bg-primary hover:bg-primary-hover text-white py-3 rounded-lg font-bold text-center transition-colors">
                Lanjut Belanja
            </a>
            <a href="#" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-900 py-3 rounded-lg font-bold text-center transition-colors">
                Lihat Detail Pesanan
            </a>
        </div>
    </div>
</div>
@endsection

