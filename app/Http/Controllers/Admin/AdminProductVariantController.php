<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminProductVariantController extends Controller
{
    public function index(Product $product): View
    {
        $product->load('variants');

        return view('admin.variants.index', compact('product'));
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'size' => [
                'required',
                'string',
                'max:50',
                Rule::unique('product_variants', 'size')->where(function ($query) use ($product) {
                    return $query->where('product_id', $product->id);
                }),
            ],
            'stock' => 'required|integer|min:0',
            'additional_price' => 'nullable|integer',
            'sku' => 'nullable|string|max:100',
        ], [
            'size.unique' => 'Ukuran ini sudah terdaftar untuk produk ini. Silakan ubah stok pada ukuran yang sudah ada.',
        ]);

        $product->variants()->create([
            'size' => strtoupper(trim((string) $validated['size'])),
            'stock' => (int) $validated['stock'],
            'additional_price' => (int) ($validated['additional_price'] ?? 0),
            'sku' => $validated['sku'] ?? null,
            'is_active' => true,
        ]);

        $this->syncProductStock($product);

        return back()->with('success', 'Variasi ukuran '.strtoupper($validated['size']).' berhasil ditambahkan!');
    }

    public function update(Request $request, ProductVariant $variant): RedirectResponse
    {
        $product = $variant->product;

        $validated = $request->validate([
            'size' => [
                'required',
                'string',
                'max:50',
                Rule::unique('product_variants', 'size')
                    ->where(function ($query) use ($product) {
                        return $query->where('product_id', $product->id);
                    })
                    ->ignore($variant->id),
            ],
            'stock' => 'required|integer|min:0',
            'additional_price' => 'nullable|integer',
            'sku' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $variant->update([
            'size' => strtoupper(trim((string) $validated['size'])),
            'stock' => (int) $validated['stock'],
            'additional_price' => (int) ($validated['additional_price'] ?? 0),
            'sku' => $validated['sku'] ?? null,
            'is_active' => $request->has('is_active') ? (bool) $request->input('is_active') : true,
        ]);

        $this->syncProductStock($product);

        return back()->with('success', 'Variasi ukuran '.$variant->size.' berhasil diperbarui!');
    }

    public function destroy(ProductVariant $variant): RedirectResponse
    {
        $product = $variant->product;
        $size = $variant->size;
        $variant->delete();

        $this->syncProductStock($product);

        return back()->with('success', 'Variasi ukuran '.$size.' berhasil dihapus.');
    }

    public function applyPreset(Request $request, Product $product): RedirectResponse
    {
        $preset = $request->input('preset');

        if ($preset === 'clear') {
            $product->variants()->delete();
            $product->update(['stock' => 25]);

            return back()->with('success', 'Semua variasi ukuran berhasil dihapus. Produk kini berstatus tanpa ukuran.');
        }

        $presets = [
            'clothing' => [
                ['size' => 'S', 'stock' => 10, 'additional_price' => 0],
                ['size' => 'M', 'stock' => 15, 'additional_price' => 0],
                ['size' => 'L', 'stock' => 12, 'additional_price' => 0],
                ['size' => 'XL', 'stock' => 8, 'additional_price' => 0],
                ['size' => 'XXL', 'stock' => 0, 'additional_price' => 15000],
            ],
            'shoes' => [
                ['size' => '39', 'stock' => 5, 'additional_price' => 0],
                ['size' => '40', 'stock' => 8, 'additional_price' => 0],
                ['size' => '41', 'stock' => 12, 'additional_price' => 0],
                ['size' => '42', 'stock' => 7, 'additional_price' => 0],
                ['size' => '43', 'stock' => 0, 'additional_price' => 0],
                ['size' => '44', 'stock' => 4, 'additional_price' => 0],
            ],
            'pants' => [
                ['size' => '28', 'stock' => 6, 'additional_price' => 0],
                ['size' => '30', 'stock' => 12, 'additional_price' => 0],
                ['size' => '32', 'stock' => 10, 'additional_price' => 0],
                ['size' => '34', 'stock' => 5, 'additional_price' => 0],
                ['size' => '36', 'stock' => 0, 'additional_price' => 0],
            ],
        ];

        if (! isset($presets[$preset])) {
            return back()->with('error', 'Preset ukuran tidak dikenali.');
        }

        foreach ($presets[$preset] as $v) {
            ProductVariant::updateOrCreate(
                ['product_id' => $product->id, 'size' => $v['size']],
                [
                    'stock' => $v['stock'],
                    'additional_price' => $v['additional_price'],
                    'sku' => strtoupper($product->slug).'-'.$v['size'],
                    'is_active' => true,
                ]
            );
        }

        $this->syncProductStock($product);

        return back()->with('success', 'Preset ukuran berhasil diterapkan untuk produk ini!');
    }

    protected function syncProductStock(Product $product): void
    {
        $hasVariants = $product->variants()->exists();
        if ($hasVariants) {
            $total = (int) $product->variants()->where('is_active', true)->sum('stock');
            $product->update(['stock' => $total]);
        }
    }
}
