<?php

namespace Database\Seeders;

use App\Data\DummyProducts;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rawProducts = DummyProducts::get();

        foreach ($rawProducts as $item) {
            $product = Product::updateOrCreate(
                ['id' => $item['id']],
                [
                    'slug' => $item['slug'],
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'original_price' => $item['original_price'] ?? null,
                    'discount_percentage' => $item['discount_percentage'] ?? 0,
                    'category' => $item['category'],
                    'brand' => $item['brand'] ?? 'ALLWEAR',
                    'image' => $item['image'],
                    'gallery' => $item['gallery'] ?? [$item['image']],
                    'rating' => $item['rating'] ?? 5.0,
                    'review_count' => $item['review_count'] ?? 0,
                    'sold_count' => $item['sold_count'] ?? 0,
                    'stock' => $item['stock'] ?? 30,
                    'min_order' => $item['min_order'] ?? 1,
                    'condition' => $item['condition'] ?? 'Baru',
                    'availability' => $item['availability'] ?? 'Siap Dikirim',
                    'supplier' => $item['supplier'] ?? 'Toko Terverifikasi',
                    'specifications' => $item['specifications'] ?? [],
                    'tags' => $item['tags'] ?? [],
                    'address' => $item['address'] ?? null,
                    'map_url' => $item['map_url'] ?? null,
                    'latitude' => $item['latitude'] ?? null,
                    'longitude' => $item['longitude'] ?? null,
                ]
            );

            // Determine if product should have size variants based on category
            $category = strtolower((string) $item['category']);
            $variantsData = [];

            if (in_array($category, ['kemeja', 'kaos'])) {
                $variantsData = [
                    ['size' => 'S', 'stock' => 10, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-S'],
                    ['size' => 'M', 'stock' => 15, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-M'],
                    ['size' => 'L', 'stock' => 12, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-L'],
                    ['size' => 'XL', 'stock' => 8, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-XL'],
                    ['size' => 'XXL', 'stock' => 0, 'additional_price' => 15000, 'sku' => strtoupper($item['slug']).'-XXL'],
                ];
            } elseif ($category === 'celana') {
                $variantsData = [
                    ['size' => '28', 'stock' => 6, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-28'],
                    ['size' => '30', 'stock' => 14, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-30'],
                    ['size' => '32', 'stock' => 10, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-32'],
                    ['size' => '34', 'stock' => 5, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-34'],
                    ['size' => '36', 'stock' => 0, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-36'],
                ];
            } elseif ($category === 'alas kaki') {
                $variantsData = [
                    ['size' => '39', 'stock' => 5, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-39'],
                    ['size' => '40', 'stock' => 8, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-40'],
                    ['size' => '41', 'stock' => 12, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-41'],
                    ['size' => '42', 'stock' => 7, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-42'],
                    ['size' => '43', 'stock' => 0, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-43'],
                    ['size' => '44', 'stock' => 4, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-44'],
                ];
            } elseif ($category === 'outer') {
                $variantsData = [
                    ['size' => 'S', 'stock' => 6, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-S'],
                    ['size' => 'M', 'stock' => 12, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-M'],
                    ['size' => 'L', 'stock' => 8, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-L'],
                    ['size' => 'XL', 'stock' => 0, 'additional_price' => 15000, 'sku' => strtoupper($item['slug']).'-XL'],
                ];
            } elseif (in_array($category, ['blouse', 'dress', 'rok'])) {
                $variantsData = [
                    ['size' => 'S', 'stock' => 8, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-S'],
                    ['size' => 'M', 'stock' => 14, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-M'],
                    ['size' => 'L', 'stock' => 10, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-L'],
                    ['size' => 'XL', 'stock' => 0, 'additional_price' => 0, 'sku' => strtoupper($item['slug']).'-XL'],
                ];
            }
            // Categories 'aksesoris', 'tas', 'hijab' have NO variants!

            if (! empty($variantsData)) {
                $totalStock = 0;
                foreach ($variantsData as $v) {
                    ProductVariant::updateOrCreate(
                        ['product_id' => $product->id, 'size' => $v['size']],
                        [
                            'stock' => $v['stock'],
                            'additional_price' => $v['additional_price'],
                            'sku' => $v['sku'],
                            'is_active' => true,
                        ]
                    );
                    $totalStock += $v['stock'];
                }

                // Sync parent product stock with sum of variant stocks
                $product->update(['stock' => $totalStock]);
            }
        }
    }
}
