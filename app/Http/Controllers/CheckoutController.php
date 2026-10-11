<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $this->cartService->getTotal();
        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'postal_code' => 'required|string',
            'shipping' => 'required|string',
            'payment' => 'required|string',
        ]);

        $cart = $this->cartService->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Simulate order creation
        $orderId = 'ORD-' . strtoupper(uniqid());

        // Clear cart
        $this->cartService->clear();

        return redirect()->route('checkout.success', ['order' => $orderId]);
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order');
        if (!$orderId) {
            return redirect()->route('home');
        }

        return view('checkout.success', compact('orderId'));
    }
}
