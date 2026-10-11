@extends('layouts.app')

@section('title', 'Pembayaran - Odaplace')

@section('content')
<div class="max-w-[1440px] mx-auto px-4 lg:px-8">
    <div class="py-4 flex items-center gap-2 text-sm text-gray-500 mb-4">
        <a href="{{ route('cart.index') }}" class="hover:text-primary"><i data-lucide="arrow-left" class="w-4 h-4 inline"></i> Kembali ke Keranjang</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-900 mb-8">Pembayaran</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form -->
        <div class="lg:col-span-2">
            <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Alamat Pengiriman -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">1</span>
                        Alamat Pengiriman
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Full Name *</label>
                            <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="John Doe">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Phone Number *</label>
                            <input type="text" name="phone" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="+1 234 567 8900">
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Street Address *</label>
                            <input type="text" name="address" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="123 Main St, Apt 4B">
                            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">State / Province *</label>
                            <input type="text" name="province" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Jakarta">
                            @error('province') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">City *</label>
                            <input type="text" name="city" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Jakarta City">
                            @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">District *</label>
                            <input type="text" name="district" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Manhattan">
                            @error('district') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">ZIP / Postal Code *</label>
                            <input type="text" name="postal_code" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="10001">
                            @error('postal_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Metode Pengiriman -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">2</span>
                        Metode Pengiriman
                    </h2>
                    
                    <div class="space-y-4">
                        <label class="relative flex items-start gap-4 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-primary transition-colors bg-white group" x-data="{ selected: true }" @click="document.getElementById('ship_std').checked = true; document.querySelectorAll('.ship-card').forEach(c => c.classList.remove('border-primary', 'bg-orange-50/30')); $el.classList.add('border-primary', 'bg-orange-50/30')">
                            <div class="flex items-center h-6">
                                <input id="ship_std" type="radio" name="shipping" value="standard" checked class="w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-900 block mb-1">Standard Pengiriman</span>
                                    <span class="font-bold text-gray-900">Gratis</span>
                                </div>
                                <span class="text-sm text-gray-500 block">Delivery in 5-7 business days</span>
                            </div>
                        </label>
                        
                        <label class="relative flex items-start gap-4 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-primary transition-colors bg-white group ship-card" @click="document.getElementById('ship_exp').checked = true; document.querySelectorAll('.ship-card').forEach(c => c.classList.remove('border-primary', 'bg-orange-50/30')); $el.classList.add('border-primary', 'bg-orange-50/30')">
                            <div class="flex items-center h-6">
                                <input id="ship_exp" type="radio" name="shipping" value="express" class="w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-900 block mb-1">Express Pengiriman</span>
                                    <span class="font-bold text-gray-900">$25.00</span>
                                </div>
                                <span class="text-sm text-gray-500 block">Delivery in 2-3 business days</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">3</span>
                        Metode Pembayaran
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- Demo Mode Banner -->
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg flex items-start gap-3 mb-6">
                            <i data-lucide="info" class="w-5 h-5 mt-0.5 shrink-0"></i>
                            <p class="text-sm">This is a demo checkout. No real payment is processed. Selecting a payment method below is just for simulation.</p>
                        </div>
                        
                        <label class="flex items-center gap-4 p-4 border border-primary bg-orange-50/30 rounded-xl cursor-pointer">
                            <div class="flex items-center h-6">
                                <input type="radio" name="payment" value="credit_card" checked class="w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary">
                            </div>
                            <div class="flex-1 flex items-center justify-between">
                                <span class="font-bold text-gray-900">Kartu Kredit / Debit</span>
                                <div class="flex gap-2 text-gray-400">
                                    <i data-lucide="credit-card" class="w-6 h-6"></i>
                                </div>
                            </div>
                        </label>
                        
                        <label class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl cursor-pointer">
                            <div class="flex items-center h-6">
                                <input type="radio" name="payment" value="paypal" class="w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary disabled:opacity-50">
                            </div>
                            <div class="flex-1 flex items-center justify-between">
                                <span class="font-bold text-gray-900">PayPal</span>
                            </div>
                        </label>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm sticky top-24">
                <h3 class="font-bold text-gray-900 text-lg mb-6">Ringkasan Pesanan</h3>
                
                <div class="space-y-4 mb-6 max-h-60 overflow-y-auto pr-2">
                    @foreach($cart as $item)
                    <div class="flex items-start gap-3">
                        <div class="w-16 h-16 rounded border border-gray-200 overflow-hidden shrink-0 relative bg-gray-50">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                            <span class="absolute -top-1 -right-1 bg-gray-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">{{ $item['quantity'] }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 line-clamp-2 leading-snug">{{ $item['name'] }}</h4>
                            <span class="text-sm font-bold text-gray-900 mt-1 block">Rp {{ number_format($item['price'], 0, ",", ".") }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <hr class="border-gray-200 mb-6">
                
                <div class="space-y-3 mb-6 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-medium text-gray-900">Rp {{ number_format($total, 0, ",", ".") }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Pengiriman</span>
                        <span class="font-medium text-green-600">Gratis</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Pajak</span>
                        <span class="font-medium text-gray-900">$0.00</span>
                    </div>
                </div>
                
                <hr class="border-gray-200 mb-6">
                
                <div class="flex justify-between mb-8">
                    <span class="font-bold text-gray-900 text-lg">Total</span>
                    <span class="font-bold text-gray-900 text-2xl">Rp {{ number_format($total, 0, ",", ".") }}</span>
                </div>
                
                <button type="submit" form="checkoutForm" class="w-full flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white py-4 rounded-xl font-bold text-lg transition-colors shadow-lg shadow-gray-900/20 mb-4">
                    Buat Pesanan <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

