<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $sessionKey = 'shopping_cart';

    public function getCart(): array
    {
        return Session::get($this->sessionKey, []);
    }

    /**
     * Add an item to the cart with optional size variant.
     */
    public function add(array|Product $product, array|ProductVariant|null $variant = null, int $quantity = 1): void
    {
        $cart = $this->getCart();

        $productId = is_array($product) ? $product['id'] : $product->id;
        $productSlug = is_array($product) ? $product['slug'] : $product->slug;
        $productName = is_array($product) ? $product['name'] : $product->name;
        $productBrand = is_array($product) ? $product['brand'] : $product->brand;
        $productImage = is_array($product) ? $product['image'] : $product->image;
        $basePrice = is_array($product) ? (int) $product['price'] : (int) $product->price;

        $variantId = null;
        $size = null;
        $additionalPrice = 0;
        $stock = is_array($product) ? (int) $product['stock'] : (int) $product->stock;

        if ($variant !== null) {
            $variantId = is_array($variant) ? $variant['id'] : $variant->id;
            $size = is_array($variant) ? $variant['size'] : $variant->size;
            $additionalPrice = is_array($variant) ? (int) ($variant['additional_price'] ?? 0) : (int) $variant->additional_price;
            $stock = is_array($variant) ? (int) $variant['stock'] : (int) $variant->stock;
        }

        $effectivePrice = $basePrice + $additionalPrice;
        $itemKey = $variantId ? "{$productId}_{$variantId}" : (string) $productId;

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity'] += $quantity;
        } else {
            $cart[$itemKey] = [
                'id' => $itemKey,
                'cart_item_key' => $itemKey,
                'product_id' => $productId,
                'variant_id' => $variantId,
                'size' => $size,
                'slug' => $productSlug,
                'name' => $productName,
                'brand' => $productBrand,
                'image' => $productImage,
                'base_price' => $basePrice,
                'additional_price' => $additionalPrice,
                'price' => $effectivePrice,
                'stock' => $stock,
                'quantity' => $quantity,
            ];
        }

        // Validate against stock
        if ($cart[$itemKey]['quantity'] > $stock) {
            $cart[$itemKey]['quantity'] = max(1, $stock);
        }

        Session::put($this->sessionKey, $cart);
    }

    public function update(string|int $id, int $quantity): void
    {
        $cart = $this->getCart();
        $key = (string) $id;

        if (isset($cart[$key])) {
            if ($quantity <= 0) {
                unset($cart[$key]);
            } else {
                $maxStock = $cart[$key]['stock'] ?? 999;
                $cart[$key]['quantity'] = min($quantity, $maxStock);
            }
            Session::put($this->sessionKey, $cart);
        }
    }

    public function remove(string|int $id): void
    {
        $cart = $this->getCart();
        $key = (string) $id;

        if (isset($cart[$key])) {
            unset($cart[$key]);
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
