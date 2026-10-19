<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
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

        $product = Product::with('activeVariants')->find($request->product_id);

        if (! $product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $variant = null;

        if ($product->activeVariants->isNotEmpty()) {
            // User must select a size if product has variants
            if (empty($request->size) && empty($request->variant_id)) {
                return back()->with('error', 'Silakan pilih ukuran produk terlebih dahulu.');
            }

            $variant = $product->activeVariants->first(function (ProductVariant $v) use ($request): bool {
                if ($request->filled('variant_id')) {
                    return $v->id == $request->variant_id;
                }

                return strtolower(trim((string) $v->size)) === strtolower(trim((string) $request->size));
            });

            if (! $variant) {
                return back()->with('error', 'Ukuran yang Anda pilih tidak tersedia untuk produk ini.');
            }

            // Check variant stock
            if ($variant->stock <= 0) {
                return back()->with('error', 'Maaf, ukuran '.$variant->size.' saat ini sedang habis.');
            }

            if ($request->quantity > $variant->stock) {
                return back()->with('error', 'Jumlah yang diminta melebihi sisa stok ukuran '.$variant->size.' (Stok: '.$variant->stock.').');
            }
        } else {
            // Product does not have size variants
            if ($product->stock <= 0) {
                return back()->with('error', 'Maaf, produk ini saat ini sedang habis.');
            }

            if ($request->quantity > $product->stock) {
                return back()->with('error', 'Jumlah yang diminta melebihi sisa stok produk (Stok: '.$product->stock.').');
            }
        }

        $this->cartService->add($product, $variant, (int) $request->quantity);

        if ($request->input('redirect') === 'checkout') {
            return redirect()->route('checkout.index');
        }

        $sizeMsg = $variant ? ' (Ukuran: '.$variant->size.')' : '';

        return back()->with('success', 'Produk '.$product->name.$sizeMsg.' berhasil ditambahkan ke keranjang!');
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
