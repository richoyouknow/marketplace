<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductBrandIdentityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ProductSeeder::class);
    }

    public function test_catalog_displays_allwear_brand_identity(): void
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);
        $response->assertSee('Koleksi Resmi ALLWEAR');
        $response->assertSee('Kategori Koleksi');
        $response->assertDontSee('Jenis Toko');
        $response->assertDontSee('Toko Terverifikasi');
        $response->assertDontSee('Buka alamat asli');
    }

    public function test_product_detail_displays_allwear_official_identity(): void
    {
        $product = Product::firstOrFail();

        $response = $this->get(route('products.show', $product->slug));

        $response->assertStatus(200);
        $response->assertSee('ALLWEAR Official');
        $response->assertSee('Koleksi Eksklusif ALLWEAR');
        $response->assertSee('100% Original ALLWEAR');
        $response->assertDontSee('Supplier');
        $response->assertDontSee('Buka alamat asli di Google Maps');
        $response->assertDontSee('dari alamat toko');
    }

    public function test_search_for_allwear_returns_products(): void
    {
        $response = $this->get(route('products.index', ['search' => 'Allwear']));

        $response->assertStatus(200);
        $response->assertSee('koleksi resmi ALLWEAR');
        $response->assertDontSee('Produk tidak ditemukan');
    }

    public function test_cart_displays_official_allwear_collection(): void
    {
        $product = Product::firstOrFail();

        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
            'size' => $product->hasVariants() ? $product->variants->first()->size : null,
            'variant_id' => $product->hasVariants() ? $product->variants->first()->id : null,
        ]);

        $response = $this->get(route('cart.index'));

        $response->assertStatus(200);
        $response->assertSee('Koleksi Resmi ALLWEAR');
    }
}
