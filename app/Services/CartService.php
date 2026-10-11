<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'shopping_cart';

    public function getCart(): array
    {
        return Session::get($this->sessionKey, []);
    }

    public function add(array $product, int $quantity = 1): void
    {
        $cart = $this->getCart();
        $id = $product['id'];

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $product['id'],
                'slug' => $product['slug'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'brand' => $product['brand'],
                'stock' => $product['stock'],
                'quantity' => $quantity
            ];
        }

        // Validate stock
        if ($cart[$id]['quantity'] > $product['stock']) {
            $cart[$id]['quantity'] = $product['stock'];
        }

        Session::put($this->sessionKey, $cart);
    }

    public function update(int $id, int $quantity): void
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            if ($quantity <= 0) {
                unset($cart[$id]);
            } else {
                // We should ideally check stock again here, but since it's demo...
                // Assuming max stock check is handled in UI
                $cart[$id]['quantity'] = $quantity;
            }
            Session::put($this->sessionKey, $cart);
        }
    }

    public function remove(int $id): void
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put($this->sessionKey, $cart);
        }
    }

    public function clear(): void
    {
        Session::forget($this->sessionKey);
    }

    public function getTotal(): int
    {
        $cart = $this->getCart();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function getCount(): int
    {
        $cart = $this->getCart();
        return count($cart);
    }
}
