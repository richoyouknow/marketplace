<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected OrderService $orderService
    ) {}

    public function index()
    {
        $cart = $this->cartService->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $total = $this->cartService->getTotal();

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:1000',
            'province' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'postal_code' => 'required|string|size:5',
            'notes' => 'nullable|string|max:255',
            'shipping' => 'required|in:standard,express',
            'payment' => 'required|in:bank_transfer,e_wallet,cod',
        ]);

        $cart = $this->cartService->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $subtotal = $this->cartService->getTotal();
        $order = $this->orderService->createOrder($validated, $cart, $subtotal);

        // Clear cart
        $this->cartService->clear();

        return redirect()->route('checkout.success', ['order' => $order['id']]);
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order');
        if (! $orderId) {
            return redirect()->route('home');
        }

        $order = $this->orderService->getOrder($orderId);

        return view('checkout.success', compact('orderId', 'order'));
    }

    public function orderDetail(string $orderId)
    {
        $order = $this->orderService->getOrder($orderId);
        if (! $order) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('checkout.order-detail', compact('order'));
    }

    public function ordersList()
    {
        $orders = $this->orderService->getAllOrders();

        return view('account.orders', compact('orders'));
    }
}
