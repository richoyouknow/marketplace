@extends('layouts.app')

@section('title', 'Pembayaran - ALLWEAR FASHION')

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
                    <div class="flex items-start justify-between gap-4 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">1</span>
                            Alamat Pengiriman
                        </h2>
                        <span class="text-xs text-gray-500 mt-2">* Wajib diisi</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Penerima <span class="text-red-500">*</span></label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Nama lengkap penerima">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor HP <span class="text-red-500">*</span></label>
                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required autocomplete="tel" inputmode="tel" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Contoh: 088991682058">
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea id="address" name="address" required rows="3" autocomplete="street-address" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Nama jalan, nomor rumah, gedung, atau patokan">{{ old('address') }}</textarea>
                            <p class="text-xs text-gray-500">Pastikan alamat mudah ditemukan kurir.</p>
                            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="province" class="block text-sm font-medium text-gray-700">Provinsi <span class="text-red-500">*</span></label>
                            <input id="province" type="text" name="province" value="{{ old('province') }}" required autocomplete="address-level1" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Contoh: Jawa Barat">
                            @error('province') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="city" class="block text-sm font-medium text-gray-700">Kabupaten / Kota <span class="text-red-500">*</span></label>
                            <input id="city" type="text" name="city" value="{{ old('city') }}" required autocomplete="address-level2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Contoh: Kota Bandung">
                            @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="district" class="block text-sm font-medium text-gray-700">Kecamatan <span class="text-red-500">*</span></label>
                            <input id="district" type="text" name="district" value="{{ old('district') }}" required autocomplete="address-level3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Contoh: Sukajadi">
                            @error('district') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan / Desa <span class="text-red-500">*</span></label>
                            <input id="kelurahan" type="text" name="kelurahan" value="{{ old('kelurahan') }}" required autocomplete="address-line2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Contoh: Pasteur">
                            @error('kelurahan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="postal_code" class="block text-sm font-medium text-gray-700">Kode Pos <span class="text-red-500">*</span></label>
                            <input id="postal_code" type="text" name="postal_code" value="{{ old('postal_code') }}" required maxlength="5" inputmode="numeric" autocomplete="postal-code" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Contoh: 40161">
                            @error('postal_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Catatan untuk Kurir <span class="font-normal text-gray-400">(opsional)</span></label>
                            <input id="notes" type="text" name="notes" value="{{ old('notes') }}" maxlength="255" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Contoh: Titip di pos satpam, rumah pagar hitam">
                        </div>
                    </div>
                </div>

                <!-- Metode Pengiriman -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">2</span>
                        Pilih Pengiriman
                    </h2>
                    <div class="space-y-4">
                        <label class="ship-card relative flex items-start gap-4 p-4 border border-primary bg-orange-50/30 rounded-xl cursor-pointer hover:border-primary transition-colors">
                            <input id="ship_std" type="radio" name="shipping" value="standard" checked class="mt-1 w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary">
                            <div class="flex-1">
                                <div class="flex items-center justify-between gap-4"><span class="font-bold text-gray-900">Reguler</span><span class="font-bold text-green-600">Gratis</span></div>
                                <span class="text-sm text-gray-500 block mt-1">Estimasi tiba 2–5 hari kerja</span>
                            </div>
                        </label>
                        <label class="ship-card relative flex items-start gap-4 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-primary transition-colors">
                            <input id="ship_exp" type="radio" name="shipping" value="express" class="mt-1 w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary">
                            <div class="flex-1">
                                <div class="flex items-center justify-between gap-4"><span class="font-bold text-gray-900">Express</span><span class="font-bold text-gray-900">Rp 25.000</span></div>
                                <span class="text-sm text-gray-500 block mt-1">Estimasi tiba 1–2 hari kerja</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 md:p-8 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">3</span>
                        Pilih Pembayaran
                    </h2>
                    <div class="space-y-4">
                        <label class="flex items-center gap-4 p-4 border border-primary bg-orange-50/30 rounded-xl cursor-pointer">
                            <input type="radio" name="payment" value="bank_transfer" checked class="w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary">
                            <div class="flex-1 flex items-center justify-between"><span class="font-bold text-gray-900">Transfer Bank</span><i data-lucide="landmark" class="w-6 h-6 text-gray-400"></i></div>
                        </label>
                        <label class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-primary">
                            <input type="radio" name="payment" value="e_wallet" class="w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary">
                            <div class="flex-1 flex items-center justify-between"><span class="font-bold text-gray-900">E-Wallet (GoPay, OVO, DANA)</span><i data-lucide="smartphone" class="w-6 h-6 text-gray-400"></i></div>
                        </label>
                        <label class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-primary">
                            <input type="radio" name="payment" value="cod" class="w-5 h-5 text-primary border-gray-300 focus:ring-primary accent-primary">
                            <div class="flex-1 flex items-center justify-between"><span class="font-bold text-gray-900">COD (Bayar di Tempat)</span><i data-lucide="banknote" class="w-6 h-6 text-gray-400"></i></div>
                        </label>
                        <p class="text-xs text-gray-500 flex gap-2 items-start"><i data-lucide="info" class="w-4 h-4 shrink-0"></i> Pembayaran diproses secara aman. Untuk demo, pesanan langsung dibuat setelah formulir dikirim.</p>
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
                        <span class="font-medium text-gray-900">Rp 0</span>
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

