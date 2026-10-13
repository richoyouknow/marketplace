<?php

namespace App\Services;

use App\Data\DummyProducts;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductCatalogService
{
    protected Collection $products;

    public function __construct()
    {
        $this->products = collect(DummyProducts::get());
    }

    public function getAll(): Collection
    {
        return $this->products;
    }

    public function getFeatured(int $limit = 8): Collection
    {
        return $this->products->whereIn('id', [1, 5, 8, 9, 10, 12, 19, 20])->take($limit);
    }

    public function getBestSellers(int $limit = 8): Collection
    {
        return $this->products->sortByDesc('sold_count')->take($limit);
    }

    public function getNewArrivals(int $limit = 8): Collection
    {
        return $this->products->sortByDesc('created_at')->take($limit);
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->products->firstWhere('slug', $slug);
    }

    public function searchAndFilter(array $filters): LengthAwarePaginator
    {
        $query = $this->products;

        if (! empty($filters['search'])) {
            $search = strtolower($filters['search']);
            $query = $query->filter(function ($product) use ($search) {
                return str_contains(strtolower($product['name']), $search) ||
                       str_contains(strtolower($product['brand']), $search) ||
                       str_contains(strtolower($product['category']), $search);
            });
        }

        if (! empty($filters['category'])) {
            $category = strtolower(trim((string) $filters['category']));
            $query = $query->filter(fn (array $product) => strtolower((string) $product['category']) === $category);
        }

        if (! empty($filters['min_price'])) {
            $query = $query->where('price', '>=', (int) $filters['min_price']);
        }

        if (! empty($filters['max_price'])) {
            $query = $query->where('price', '<=', (int) $filters['max_price']);
        }

        if (! empty($filters['supplier_types'])) {
            // Supplier types filter
            $query = $query->whereIn('supplier', (array) $filters['supplier_types']);
        }

        if (! empty($filters['product_types'])) {
            // Product types (availability) filter
            $types = collect((array) $filters['product_types'])->flatMap(function ($type) {
                if ($type === 'Ready to Ship' || $type === 'Siap Dikirim') {
                    return ['Siap Dikirim', 'Ready to Ship'];
                }

                return [$type];
            })->all();
            $query = $query->whereIn('availability', $types);
        }

        if (! empty($filters['condition'])) {
            // Condition filter
            $query = $query->whereIn('condition', (array) $filters['condition']);
        }

        if (! empty($filters['min_order'])) {
            $query = $query->where('min_order', '<=', (int) $filters['min_order']);
        }

        if (! empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_asc':
                    $query = $query->sortBy('price');
                    break;
                case 'price_desc':
                    $query = $query->sortByDesc('price');
                    break;
                case 'newest':
                    $query = $query->sortByDesc('created_at');
                    break;
                case 'best_match':
                default:
                    break;
            }
        }

        if (! empty($filters['nearby']) && is_numeric($filters['latitude'] ?? null) && is_numeric($filters['longitude'] ?? null)) {
            $latitude = (float) $filters['latitude'];
            $longitude = (float) $filters['longitude'];
            $query = $query->sortBy(function (array $product) use ($latitude, $longitude): float {
                $earthRadius = 6371;
                $latDelta = deg2rad($product['latitude'] - $latitude);
                $lonDelta = deg2rad($product['longitude'] - $longitude);
                $a = sin($latDelta / 2) ** 2
                    + cos(deg2rad($latitude)) * cos(deg2rad($product['latitude'])) * sin($lonDelta / 2) ** 2;

                return $earthRadius * 2 * asin(min(1, sqrt($a)));
            });
        }

        $page = $filters['page'] ?? 1;
        $perPage = $filters['per_page'] ?? 16;

        // Return Paginator
        return new LengthAwarePaginator(
            $query->forPage($page, $perPage)->values(),
            $query->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
