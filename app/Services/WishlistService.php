<?php

namespace App\Services;

use App\Data\DummyProducts;
use Illuminate\Support\Collection;

class WishlistService
{
    private const SESSION_KEY = 'wishlist_product_ids';

    public function ids(): array
    {
        return collect(session(self::SESSION_KEY, []))
            ->map(fn ($id) => (int) $id)
            ->filter(fn (int $id) => $id > 0)
            ->unique()
            ->values()
            ->all();
    }

    public function products(): Collection
    {
        $ids = $this->ids();

        return collect(DummyProducts::get())
            ->filter(fn (array $product) => in_array($product['id'], $ids, true))
            ->values();
    }

    public function contains(int $productId): bool
    {
        return in_array($productId, $this->ids(), true);
    }

    public function toggle(int $productId): bool
    {
        $ids = $this->ids();

        if (in_array($productId, $ids, true)) {
            $ids = array_values(array_filter($ids, fn (int $id) => $id !== $productId));
            $added = false;
        } else {
            $ids[] = $productId;
            $added = true;
        }

        session([self::SESSION_KEY => $ids]);

        return $added;
    }

    public function remove(int $productId): void
    {
        session([
            self::SESSION_KEY => array_values(array_filter(
                $this->ids(),
                fn (int $id) => $id !== $productId
            )),
        ]);
    }
}
