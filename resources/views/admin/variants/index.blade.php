@extends('layouts.admin')

@section('title', 'Kelola Variasi Ukuran - ' . $product->name)

@section('content')
<div x-data="{
    editModalOpen: false,
    editVariant: { id: null, size: '', stock: 0, additional_price: 0, sku: '', is_active: true },
    openEdit(v) {
        this.editVariant = Object.assign({}, v);
        this.editModalOpen = true;
    }
}" class="space-y-8">

    <!-- Breadcrumb & Back -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('admin.products.index') }}" class="hover:text-primary transition flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar Produk
            </a>
            <span>/</span>
            <span class="text-gray-900 font-bold truncate max-w-xs">{{ $product->name }}</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 text-xs font-bold transition shadow-xs">
                <i data-lucide="external-link" class="w-3.5 h-3.5 text-primary"></i>
                <span>Lihat di Toko</span>
            </a>
        </div>
    </div>

    <!-- Product Overview Card -->
    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-20 h-20 rounded-2xl border border-gray-200 overflow-hidden shrink-0 bg-gray-50">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-primary">{{ $product->brand }} • Kategori: {{ ucfirst($product->category) }}</span>
                <h1 class="text-xl font-bold text-gray-900 mt-0.5">{{ $product->name }}</h1>
                <div class="flex flex-wrap items-center gap-4 mt-2 text-xs text-gray-500">
                    <span>Harga Dasar: <strong class="text-gray-900 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</strong></span>
                    <span>•</span>
                    <span>Total Stok: <strong class="text-emerald-700 font-bold">{{ $product->stock }} buah</strong></span>
                    <span>•</span>
                    <span>Variasi Terdaftar: <strong class="text-gray-900 font-semibold">{{ $product->variants->count() }} ukuran</strong></span>
                </div>
            </div>
        </div>

        <!-- Quick Presets -->
        <div class="flex flex-col items-start md:items-end gap-2 w-full md:w-auto border-t md:border-t-0 pt-4 md:pt-0 border-gray-100">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi Cepat Preset:</span>
            <div class="flex flex-wrap items-center gap-2">
                <form action="{{ route('admin.products.variants.preset', $product->id) }}" method="POST" onsubmit="return confirm('Terapkan preset ukuran pakaian (S, M, L, XL, XXL)?');">
                    @csrf
                    <input type="hidden" name="preset" value="clothing">
                    <button type="submit" class="px-3 py-1.5 rounded-lg border border-orange-200 bg-orange-50 hover:bg-orange-100 text-orange-800 text-xs font-bold transition">
                        + Preset Pakaian (S-XXL)
                    </button>
                </form>

                <form action="{{ route('admin.products.variants.preset', $product->id) }}" method="POST" onsubmit="return confirm('Terapkan preset ukuran sepatu (39-44)?');">
                    @csrf
                    <input type="hidden" name="preset" value="shoes">
                    <button type="submit" class="px-3 py-1.5 rounded-lg border border-blue-200 bg-blue-50 hover:bg-blue-100 text-blue-800 text-xs font-bold transition">
                        + Preset Sepatu (39-44)
                    </button>
                </form>

                @if($product->variants->isNotEmpty())
                <form action="{{ route('admin.products.variants.preset', $product->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Hapus semua variasi ukuran untuk produk ini? Produk akan menjadi produk tanpa variasi ukuran.');">
                    @csrf
                    <input type="hidden" name="preset" value="clear">
                    <button type="submit" class="px-3 py-1.5 rounded-lg border border-red-200 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-bold transition">
                        Hapus Semua Ukuran
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Grid: Variant Form & Table -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Form Tambah Variasi Baru -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-xs sticky top-24">
                <div class="flex items-center gap-2 border-b border-gray-100 pb-4 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-orange-100 text-primary flex items-center justify-center font-bold">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Tambah Ukuran Baru</h2>
                        <p class="text-xs text-gray-500">Daftarkan ukuran baru untuk produk ini</p>
                    </div>
                </div>

                <form action="{{ route('admin.products.variants.store', $product->id) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Ukuran -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                            Ukuran (Size) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="size" id="input_size" required placeholder="Contoh: S, M, L, XL, 42" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 uppercase font-bold text-gray-900">
                        
                        <!-- Quick Pick Buttons -->
                        <div class="flex flex-wrap items-center gap-1.5 mt-2">
                            <span class="text-[11px] text-gray-400">Pilih cepat:</span>
                            @foreach(['S', 'M', 'L', 'XL', 'XXL', '39', '40', '41', '42'] as $quick)
                            <button type="button" onclick="document.getElementById('input_size').value = '{{ $quick }}';" class="px-2 py-0.5 rounded text-[11px] font-bold bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
                                {{ $quick }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                            Jumlah Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stock" required min="0" value="10" placeholder="0" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 font-bold text-gray-900">
                        <span class="text-[11px] text-gray-400 mt-1 block">Set ke 0 jika variasi saat ini habis.</span>
                    </div>

                    <!-- Harga Tambahan -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                            Harga Tambahan (Opsional)
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-2.5 text-xs font-bold text-gray-400">Rp</span>
                            <input type="number" name="additional_price" min="0" step="1000" value="0" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 font-semibold text-gray-900">
                        </div>
                        <span class="text-[11px] text-gray-400 mt-1 block">Biaya ekstra khusus ukuran ini (misal XXL +Rp 15.000).</span>
                    </div>

                    <!-- SKU -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                            SKU / Kode Varian (Opsional)
                        </label>
                        <input type="text" name="sku" placeholder="Contoh: {{ strtoupper($product->slug) }}-XL" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 font-mono text-xs uppercase text-gray-700">
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-xl font-bold text-sm transition-colors shadow-md shadow-orange-500/20 flex items-center justify-center gap-2 mt-4">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Variasi Ukuran
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar Variasi Saat Ini -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-xs overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Daftar Variasi Ukuran Produk</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Semua ukuran yang terhubung dengan produk ini di database</p>
                    </div>
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold">
                        {{ $product->variants->count() }} Ukuran
                    </span>
                </div>

                @if($product->variants->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-400 mb-4">
                        <i data-lucide="tag" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 mb-1">Produk Ini Belum Memiliki Variasi Ukuran</h3>
                    <p class="text-sm text-gray-500 max-w-sm mx-auto mb-6">
                        Produk ini saat ini diperlakukan sebagai produk tunggal tanpa pilihan ukuran (seperti aksesoris atau tas). Gunakan form di sebelah kiri atau pilih preset untuk menambahkan variasi ukuran.
                    </p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-700">
                        <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase font-bold text-gray-500 tracking-wider">
                            <tr>
                                <th class="py-3.5 px-6">Ukuran</th>
                                <th class="py-3.5 px-4">Stok</th>
                                <th class="py-3.5 px-4">Harga Tambahan</th>
                                <th class="py-3.5 px-4">Harga Total</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($product->variants as $variant)
                            <tr class="hover:bg-gray-50/70 transition-colors {{ $variant->stock <= 0 ? 'bg-red-50/20' : '' }}">
                                <!-- Size -->
                                <td class="py-4 px-6 font-black text-base text-gray-900">
                                    <span class="inline-flex items-center justify-center min-w-[36px] h-9 px-2 rounded-lg border-2 border-gray-300 bg-white shadow-2xs">
                                        {{ $variant->size }}
                                    </span>
                                    @if(!empty($variant->sku))
                                    <span class="block text-[10px] font-mono text-gray-400 mt-1">{{ $variant->sku }}</span>
                                    @endif
                                </td>

                                <!-- Stock with Visual Indicator -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    @if($variant->stock <= 0)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                        <i data-lucide="x-circle" class="w-3.5 h-3.5"></i> Habis (0)
                                    </span>
                                    @elseif($variant->stock <= 5)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                        <i data-lucide="alert-triangle" class="w-3.5 h-3.5"></i> Menipis ({{ $variant->stock }})
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i> Tersedia ({{ $variant->stock }})
                                    </span>
                                    @endif
                                </td>

                                <!-- Additional Price -->
                                <td class="py-4 px-4 whitespace-nowrap font-medium text-gray-600">
                                    @if($variant->additional_price > 0)
                                    <span class="text-orange-600 font-bold">+Rp {{ number_format($variant->additional_price, 0, ',', '.') }}</span>
                                    @else
                                    <span class="text-gray-400">Rp 0</span>
                                    @endif
                                </td>

                                <!-- Effective Total Price -->
                                <td class="py-4 px-4 whitespace-nowrap font-bold text-gray-900">
                                    Rp {{ number_format($product->price + $variant->additional_price, 0, ',', '.') }}
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-4 whitespace-nowrap">
                                    @if($variant->is_active)
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400">
                                        <span class="w-2 h-2 rounded-full bg-gray-400"></span> Nonaktif
                                    </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Tombol Edit -->
                                        <button type="button" @click="openEdit({{ Js::from($variant) }})" class="p-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition" title="Ubah ukuran atau stok">
                                            <i data-lucide="edit-2" class="w-4 h-4"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.variants.destroy', $variant->id) }}" method="POST" onsubmit="return confirm('Hapus variasi ukuran {{ $variant->size }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 transition" title="Hapus variasi ukuran ini">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Edit Variasi Ukuran -->
    <div x-show="editModalOpen" x-transition.opacity class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4" style="display: none;">
        <div @click.outside="editModalOpen = false" class="bg-white rounded-2xl border border-gray-200 shadow-2xl w-full max-w-md overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-orange-100 text-primary flex items-center justify-center font-bold">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 text-base">Ubah Variasi Ukuran</h3>
                </div>
                <button type="button" @click="editModalOpen = false" class="text-gray-400 hover:text-gray-600 p-1">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form :action="'{{ url('/admin/variants') }}/' + editVariant.id" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                        Ukuran (Size)
                    </label>
                    <input type="text" name="size" x-model="editVariant.size" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-bold uppercase focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                        Jumlah Stok
                    </label>
                    <input type="number" name="stock" x-model="editVariant.stock" min="0" required class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-bold focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <span class="text-[11px] text-gray-400 mt-1 block">Set 0 untuk menandai ukuran ini habis.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                        Harga Tambahan (Rp)
                    </label>
                    <input type="number" name="additional_price" x-model="editVariant.additional_price" min="0" step="1000" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-semibold focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-1.5">
                        SKU
                    </label>
                    <input type="text" name="sku" x-model="editVariant.sku" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm font-mono text-xs uppercase focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_active" id="modal_is_active" value="1" x-model="editVariant.is_active" class="w-4 h-4 text-primary rounded border-gray-300 focus:ring-primary accent-primary">
                    <label for="modal_is_active" class="text-sm font-medium text-gray-800">Aktifkan variasi ukuran ini</label>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                    <button type="button" @click="editModalOpen = false" class="flex-1 py-2.5 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 font-semibold text-sm transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 py-2.5 rounded-xl bg-primary hover:bg-primary-hover text-white font-bold text-sm transition shadow-md shadow-orange-500/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
