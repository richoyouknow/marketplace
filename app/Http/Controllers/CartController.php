<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use App\Services\ProductCatalogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected ProductCatalogService $productService
    ) {}

    public function index(): View
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'variant_id' => 'nullable|integer',
        ]);

        $product = null;
        try {
            $product = Product::with('activeVariants')->find($request->product_id);
        } catch (\Throwable $e) {
            $product = null;
        }

        $rawProduct = null;
        if (! $product) {
            $rawProduct = $this->productService->getAll()->firstWhere('id', (int) $request->product_id);
            if (! $rawProduct) {
                return back()->with('error', 'Produk tidak ditemukan.');
            }
        }

        $variant = null;
        $variants = $product ? $product->activeVariants : collect($rawProduct['variants'] ?? []);
        $hasVariants = $variants->isNotEmpty();

        if ($hasVariants) {
            // User must select a size if product has variants
            if (empty($request->size) && empty($request->variant_id)) {
                return back()->with('error', 'Silakan pilih ukuran produk terlebih dahulu.');
            }

            $variant = $variants->first(function ($v) use ($request): bool {
                $vId = is_array($v) ? $v['id'] : $v->id;
                $vSize = is_array($v) ? $v['size'] : $v->size;

                if ($request->filled('variant_id')) {
                    return $vId == $request->variant_id;
                }

                return strtolower(trim((string) $vSize)) === strtolower(trim((string) $request->size));
            });

            if (! $variant) {
                return back()->with('error', 'Ukuran yang Anda pilih tidak tersedia untuk produk ini.');
            }

            $variantStock = is_array($variant) ? $variant['stock'] : $variant->stock;
            $variantSize = is_array($variant) ? $variant['size'] : $variant->size;

            // Check variant stock
            if ($variantStock <= 0) {
                return back()->with('error', 'Maaf, ukuran '.$variantSize.' saat ini sedang habis.');
            }

            if ($request->quantity > $variantStock) {
                return back()->with('error', 'Jumlah yang diminta melebihi sisa stok ukuran '.$variantSize.' (Stok: '.$variantStock.').');
            }
        } else {
            // Product does not have size variants
            $productStock = $product ? $product->stock : ($rawProduct['stock'] ?? 0);
            if ($productStock <= 0) {
                return back()->with('error', 'Maaf, produk ini saat ini sedang habis.');
            }

            if ($request->quantity > $productStock) {
                return back()->with('error', 'Jumlah yang diminta melebihi sisa stok produk (Stok: '.$productStock.').');
            }
        }

        $targetProduct = $product ?? $rawProduct;
        $this->cartService->add($targetProduct, $variant, (int) $request->quantity);

        if ($request->input('redirect') === 'checkout') {
            return redirect()->route('checkout.index');
        }

        $variantSize = $variant ? (is_array($variant) ? $variant['size'] : $variant->size) : null;
        $sizeMsg = $variantSize ? ' (Ukuran: '.$variantSize.')' : '';
        $productName = is_array($targetProduct) ? $targetProduct['name'] : $targetProduct->name;

        return back()->with('success', 'Produk '.$productName.$sizeMsg.' berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $this->cartService->update($id, (int) $request->quantity);

        return back()->with('success', 'Keranjang belanja berhasil diperbarui!');
    }

    public function remove(string $id): RedirectResponse
    {
        $this->cartService->remove($id);

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
