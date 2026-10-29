@props(['product'])

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden group hover:border-primary/50 card-shadow hover:card-shadow-hover transition-all duration-300 flex flex-col h-full min-w-0">
    <!-- Image -->
    <a href="{{ route('products.show', $product['slug']) }}" class="block relative aspect-[4/3] bg-gray-50 overflow-hidden shrink-0">
        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        <div class="absolute top-3 left-3 flex flex-col gap-1">
            @if(in_array('best seller', $product['tags']))
            <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-1 rounded-sm uppercase tracking-wider shadow-sm">Terlaris</span>
            @endif
            @if(in_array('new', $product['tags']))
            <span class="bg-blue-100 text-blue-600 text-[10px] font-bold px-2 py-1 rounded-sm uppercase tracking-wider shadow-sm">Baru</span>
            @endif
        </div>
    </a>
    @php($isWishlisted = app(\App\Services\WishlistService::class)->contains((int) $product['id']))
    <form action="{{ route('wishlist.toggle') }}" method="POST" class="absolute top-3 right-3 z-10 opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all shadow-sm">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
        <button type="submit" aria-label="{{ $isWishlisted ? 'Hapus dari wishlist' : 'Tambah ke wishlist' }}" class="w-8 h-8 rounded-full bg-white/80 backdrop-blur {{ $isWishlisted ? 'text-red-500' : 'text-gray-400' }} hover:text-red-500 hover:bg-white flex items-center justify-center">
            <i data-lucide="heart" class="w-4 h-4 {{ $isWishlisted ? 'fill-current' : '' }}"></i>
        </button>
    </form>

    <div class="p-4 flex flex-col flex-1 min-w-0">
        <div class="flex flex-wrap items-baseline gap-x-2 gap-y-1 mb-2">
            <span class="text-lg sm:text-xl font-bold text-gray-900">Rp {{ number_format($product['price'], 0, ",", ".") }}</span>
            @if($product['discount_percentage'] > 0)
            <span class="text-xs sm:text-sm text-gray-400 line-through">Rp {{ number_format($product['original_price'], 0, ",", ".") }}</span>
            @endif
        </div>
        <a href="{{ route('products.show', $product['slug']) }}" class="font-medium text-gray-900 text-sm leading-snug line-clamp-2 hover:text-primary transition-colors min-h-[2.5rem] mb-3">
            {{ $product['name'] }}
        </a>
        <div class="flex items-center justify-between gap-2 text-xs text-gray-500 mb-4 mt-auto">
            <div class="flex items-center gap-1 bg-yellow-50 text-yellow-700 px-1.5 py-0.5 rounded">
                <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                <span class="font-medium">{{ number_format($product['rating'], 1) }}</span>
            </div>
            <span class="truncate">Terjual {{ $product['sold_count'] }}</span>
        </div>
        <div class="flex items-center gap-1.5 text-xs text-primary mb-3 truncate">
            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-primary shrink-0"></i>
            <span class="font-semibold text-gray-700 truncate">Koleksi Resmi ALLWEAR</span>
        </div>
        @if(!empty($product['variants']))
        <a href="{{ route('products.show', $product['slug']) }}" class="w-full flex items-center justify-center gap-2 bg-orange-50 text-primary hover:bg-primary hover:text-white border border-primary/20 hover:border-primary py-2.5 rounded-lg text-sm font-semibold transition-colors">
            <i data-lucide="sliders" class="w-4 h-4"></i>
            <span>Pilih Ukuran</span>
        </a>
        @else
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-orange-50 text-primary hover:bg-primary hover:text-white border border-primary/20 hover:border-primary py-2.5 rounded-lg text-sm font-medium transition-colors">
                <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                <span>Tambah ke Keranjang</span>
            </button>
        </form>
        @endif
    </div>
</div>
