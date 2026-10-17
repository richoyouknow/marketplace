@extends('layouts.app')

@section('title', 'Wishlist - ALLWEAR FASHION')

@section('content')
<div class="max-w-[1440px] mx-auto px-4 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
        <div>
            <p class="text-sm font-semibold text-primary mb-2">Koleksi favorit</p>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Wishlist Saya</h1>
            <p class="text-gray-500 mt-2">{{ $products->count() }} produk tersimpan untuk nanti.</p>
        </div>
        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center gap-2 border border-gray-200 bg-white hover:border-primary hover:text-primary text-gray-700 font-semibold px-4 py-2.5 rounded-lg transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Lanjut Belanja
        </a>
    </div>

    @if($products->isEmpty())
    <div class="bg-white rounded-xl border border-gray-200 p-12 text-center flex flex-col items-center justify-center min-h-[400px]">
        <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-6">
            <i data-lucide="heart" class="w-10 h-10 text-primary"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Wishlist Anda masih kosong</h2>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">Simpan produk favorit dan beli kapan saja saat Anda siap.</p>
        <a href="{{ route('products.index') }}" class="bg-gray-900 hover:bg-black text-white font-bold px-8 py-3 rounded-lg transition shadow-lg shadow-gray-900/20">Jelajahi Produk</a>
    </div>
    @else
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
        @foreach($products as $product)
        <div class="relative">
            @include('components.product-card', ['product' => $product])
            <form action="{{ route('wishlist.remove', $product['id']) }}" method="POST" class="absolute top-3 right-3 z-10">
                @csrf
                @method('DELETE')
                <button type="submit" aria-label="Hapus dari wishlist" class="w-8 h-8 rounded-full bg-white/90 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center shadow-sm transition">
                    <i data-lucide="heart" class="w-4 h-4 fill-current"></i>
                </button>
            </form>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
