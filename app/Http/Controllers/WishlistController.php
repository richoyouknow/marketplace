<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;
use App\Services\WishlistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(WishlistService $wishlist)
    {
        return view('wishlist.index', [
            'products' => $wishlist->products(),
        ]);
    }

    public function toggle(Request $request, WishlistService $wishlist, ProductCatalogService $catalog): RedirectResponse
    {
        $productId = (int) $request->input('product_id');
        $product = $catalog->getAll()->firstWhere('id', $productId);

        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $added = $wishlist->toggle($productId);

        return back()->with('success', $added
            ? $product['name'] . ' ditambahkan ke wishlist.'
            : $product['name'] . ' dihapus dari wishlist.');
    }

    public function remove(int $id, WishlistService $wishlist): RedirectResponse
    {
        $wishlist->remove($id);

        return back()->with('success', 'Produk dihapus dari wishlist.');
    }
}
