@extends('layouts.admin')

@section('title', 'Kelola Variasi Ukuran Produk - Admin Panel')

@section('content')
<div class="space-y-8">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Variasi Ukuran Produk</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola ketersediaan ukuran, stok per ukuran, dan harga tambahan untuk setiap produk.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('products.index') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-sm font-semibold transition shadow-xs">
                <i data-lucide="eye" class="w-4 h-4 text-gray-500"></i>
                <span>Katalog Toko</span>
            </a>
        </div>
    </div>

    <!-- Metric Stat Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Produk</span>
                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600">
                    <i data-lucide="package" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-gray-900 mt-2">{{ $stats['total_products'] }}</div>
            <span class="text-xs text-gray-400 mt-1 block">Tersimpan di database</span>
        </div>

        <div class="bg-white border border-primary/20 rounded-2xl p-5 shadow-xs bg-gradient-to-br from-white to-orange-50/40">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-primary uppercase tracking-wider">Ada Variasi</span>
                <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-primary">
                    <i data-lucide="layers" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-primary mt-2">{{ $stats['with_variants'] }}</div>
            <span class="text-xs text-orange-600/80 mt-1 block">Produk dengan ukuran</span>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Tanpa Variasi</span>
                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600">
                    <i data-lucide="tag" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-gray-700 mt-2">{{ $stats['without_variants'] }}</div>
            <span class="text-xs text-gray-400 mt-1 block">Aksesoris / Tas / Hijab</span>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Variasi</span>
                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                    <i data-lucide="check-square" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-blue-600 mt-2">{{ $stats['total_variants'] }}</div>
            <span class="text-xs text-gray-400 mt-1 block">Ukuran terdaftar</span>
        </div>

        <div class="bg-white border {{ $stats['out_of_stock_variants'] > 0 ? 'border-red-200 bg-red-50/30' : 'border-gray-200' }} rounded-2xl p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold {{ $stats['out_of_stock_variants'] > 0 ? 'text-red-600' : 'text-gray-400' }} uppercase tracking-wider">Varian Habis</span>
                <div class="w-8 h-8 rounded-lg {{ $stats['out_of_stock_variants'] > 0 ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }} flex items-center justify-center">
                    <i data-lucide="alert-octagon" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl font-black {{ $stats['out_of_stock_variants'] > 0 ? 'text-red-600' : 'text-gray-900' }} mt-2">{{ $stats['out_of_stock_variants'] }}</div>
            <span class="text-xs {{ $stats['out_of_stock_variants'] > 0 ? 'text-red-500' : 'text-gray-400' }} mt-1 block">Stok ukuran 0</span>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-xs">
        <form action="{{ route('admin.products.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-3.5 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau brand..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
            </div>

            <!-- Category -->
            <div>
                <select name="category" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Variant Status -->
            <div>
                <select name="has_variants" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white">
                    <option value="">Semua Status Variasi</option>
                    <option value="yes" {{ request('has_variants') === 'yes' ? 'selected' : '' }}>Hanya Produk Berukuran</option>
                    <option value="no" {{ request('has_variants') === 'no' ? 'selected' : '' }}>Hanya Produk Tanpa Ukuran</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-2">
                <button type="submit" class="flex-1 bg-gray-900 hover:bg-black text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-xs flex items-center justify-center gap-2">
                    <i data-lucide="filter" class="w-4 h-4"></i> Filter
                </button>
                @if(request()->anyFilled(['search', 'category', 'has_variants']))
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-600 text-sm font-medium transition" title="Reset filter">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-700">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase font-bold text-gray-500 tracking-wider">
                    <tr>
                        <th class="py-4 px-6">Produk</th>
                        <th class="py-4 px-4">Kategori</th>
                        <th class="py-4 px-4">Harga Dasar</th>
                        <th class="py-4 px-4">Variasi Ukuran Terdaftar</th>
                        <th class="py-4 px-4 text-center">Total Stok</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    @php
                        $variants = $product->variants;
                        $hasVariants = $variants->isNotEmpty();
                    @endphp
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <!-- Product Info -->
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-xl border border-gray-200 overflow-hidden shrink-0 bg-gray-50">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-primary">{{ $product->brand }}</span>
                                    <h3 class="font-bold text-gray-900 text-sm line-clamp-1 hover:text-primary transition-colors">
                                        <a href="{{ route('admin.products.variants.index', $product->id) }}">{{ $product->name }}</a>
                                    </h3>
                                    <span class="text-xs text-gray-400 font-mono">ID: #{{ $product->id }} • {{ $product->slug }}</span>
                                </div>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="py-4 px-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-700 font-medium rounded-lg text-xs capitalize">
                                {{ $product->category }}
                            </span>
                        </td>

                        <!-- Base Price -->
                        <td class="py-4 px-4 whitespace-nowrap font-bold text-gray-900">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <!-- Size Variants Badge -->
                        <td class="py-4 px-4">
                            @if($hasVariants)
                            <div class="flex flex-wrap items-center gap-1.5 max-w-xs">
                                @foreach($variants as $v)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-bold border {{ $v->stock > 0 ? 'bg-orange-50 text-orange-800 border-orange-200' : 'bg-red-50 text-red-500 border-red-200 line-through' }}" title="Stok: {{ $v->stock }} {{ $v->additional_price > 0 ? '(+Rp ' . number_format($v->additional_price, 0, ',', '.') . ')' : '' }}">
                                    {{ $v->size }}
                                    <span class="text-[10px] font-normal {{ $v->stock > 0 ? 'text-gray-500' : 'text-red-500' }}">({{ $v->stock }})</span>
                                </span>
                                @endforeach
                            </div>
                            @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-gray-100 text-gray-500">
                                <i data-lucide="minus-circle" class="w-3 h-3"></i> Tanpa Variasi Ukuran
                            </span>
                            @endif
                        </td>

                        <!-- Total Stock -->
                        <td class="py-4 px-4 text-center whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 font-bold {{ $product->stock > 0 ? 'text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full' : 'text-red-600 bg-red-50 px-2.5 py-1 rounded-full' }}">
                                {{ $product->stock }} buah
                            </span>
                        </td>

                        <!-- Action -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.variants.index', $product->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-primary hover:bg-primary-hover text-white text-xs font-bold transition shadow-xs">
                                    <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                                    <span>Kelola Ukuran ({{ $variants->count() }})</span>
                                </a>
                                <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="p-2 rounded-xl border border-gray-200 hover:bg-gray-100 text-gray-500 hover:text-gray-900 transition" title="Lihat di Toko">
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-500">
                            <i data-lucide="inbox" class="w-12 h-12 mx-auto text-gray-300 mb-2"></i>
                            <p class="font-medium">Tidak ada produk yang sesuai dengan filter.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="p-4 border-t border-gray-200">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
