<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\ProductCatalogService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected CartService $cartService;
    protected ProductCatalogService $productService;

    public function __construct(CartService $cartService, ProductCatalogService $productService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = $this->productService->getAll()->firstWhere('id', $request->product_id);
        
        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        $this->cartService->add($product, $request->quantity);

        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $this->cartService->update($id, $request->quantity);

        return back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $this->cartService->remove($id);

        return back()->with('success', 'Product removed from cart!');
    }
}
