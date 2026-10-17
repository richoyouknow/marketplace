@extends('layouts.app')

@section('title', 'Shopping Cart - ALLWEAR FASHION')

@section('content')
<div class="max-w-[1440px] mx-auto px-4 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

    @if(empty($cart))
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center flex flex-col items-center justify-center min-h-[400px]">
            <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-6">
                <i data-lucide="shopping-cart" class="w-10 h-10 text-primary"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Looks like you haven't added anything to your cart yet. Discover great products on our store.</p>
            <a href="{{ route('products.index') }}" class="bg-primary hover:bg-primary-hover text-white font-bold px-8 py-3 rounded-lg transition shadow-lg shadow-orange-500/20">
                Lanjut Belanja
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $id => $item)
                <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6 shadow-sm relative group transition-all hover:shadow-md">
                    
                    <a href="{{ route('products.show', $item['slug']) }}" class="w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 rounded-lg border border-gray-100 overflow-hidden shrink-0 block">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </a>
                    
                    <div class="flex-1 min-w-0">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1 block">{{ $item['brand'] }}</span>
                        <a href="{{ route('products.show', $item['slug']) }}" class="font-bold text-gray-900 text-lg hover:text-primary transition-colors line-clamp-2 mb-2">
                            {{ $item['name'] }}
                        </a>
                        <div class="text-xl font-bold text-gray-900">Rp {{ number_format($item['price'], 0, ",", ".") }}</div>
                    </div>
                    
                    <div class="flex flex-row sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto gap-4 sm:gap-6 mt-4 sm:mt-0">
                        <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden h-10 w-28">
                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.form.submit()" class="w-8 h-full bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-600 transition">-</button>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" class="w-full h-full text-center text-sm font-bold text-gray-900 border-x border-gray-300 focus:outline-none appearance-none" onchange="this.form.submit()">
                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.form.submit()" class="w-8 h-full bg-gray-50 hover:bg-gray-100 flex items-center justify-center text-gray-600 transition">+</button>
                            </div>
                        </form>
                        
                        <div class="flex items-center gap-4 text-sm font-medium">
                            <span class="sm:hidden text-gray-500">Subtotal: <span class="text-gray-900 font-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ",", ".") }}</span></span>
                            
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors flex items-center gap-2" title="Remove item">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i> <span class="sm:hidden">Remove</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm sticky top-24">
                    <h3 class="font-bold text-gray-900 text-lg mb-6">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ count($cart) }} items)</span>
                            <span class="font-medium text-gray-900">Rp {{ number_format($total, 0, ",", ".") }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Pengiriman estimate</span>
                            <span class="font-medium text-gray-900">Calculated at checkout</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Pajak estimate</span>
                            <span class="font-medium text-gray-900">Calculated at checkout</span>
                        </div>
                    </div>
                    
                    <hr class="border-gray-200 mb-6">
                    
                    <div class="flex justify-between mb-8">
                        <span class="font-bold text-gray-900 text-lg">Total</span>
                        <span class="font-bold text-gray-900 text-2xl">Rp {{ number_format($total, 0, ",", ".") }}</span>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" class="w-full block text-center bg-primary hover:bg-primary-hover text-white py-4 rounded-xl font-bold text-lg transition-colors shadow-lg shadow-orange-500/30 mb-4">
                        Proceed to Pembayaran
                    </a>
                    
                    <div class="flex items-center justify-center gap-2 text-sm text-gray-500">
                        <i data-lucide="shield-check" class="w-4 h-4 text-green-500"></i> Secure Pembayaran
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

