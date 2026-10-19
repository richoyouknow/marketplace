<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductVariant;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductSizeVariantTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ProductSeeder::class);
    }

    public function test_product_with_variants_displays_size_options(): void
    {
        $product = Product::where('slug', 'kemeja-oxford-blue')->with('variants')->firstOrFail();

        $this->assertTrue($product->variants->isNotEmpty());

        $response = $this->get(route('products.show', $product->slug));
        $response->assertStatus(200);
        $response->assertSee('Pilih Ukuran:');
        $response->assertSee('Wajib memilih ukuran');
        // Check size buttons
        foreach ($product->variants as $variant) {
            $response->assertSee($variant->size);
        }
    }

    public function test_product_without_variants_does_not_display_size_options(): void
    {
        $product = Product::where('slug', 'dompet-kulit-compact')->with('variants')->firstOrFail();

        $this->assertTrue($product->variants->isEmpty());

        $response = $this->get(route('products.show', $product->slug));
        $response->assertStatus(200);
        $response->assertDontSee('Pilih Ukuran:');
    }

    public function test_adding_variant_product_without_size_fails_validation(): void
    {
        $product = Product::where('slug', 'kemeja-oxford-blue')->firstOrFail();

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
            // size omitted
        ]);

        $response->assertSessionHas('error', 'Silakan pilih ukuran produk terlebih dahulu.');
    }

    public function test_adding_out_of_stock_variant_fails_validation(): void
    {
        $product = Product::where('slug', 'kemeja-oxford-blue')->with('variants')->firstOrFail();
        $outOfStockVariant = $product->variants->firstWhere('stock', 0);

        $this->assertNotNull($outOfStockVariant);

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
            'size' => $outOfStockVariant->size,
            'variant_id' => $outOfStockVariant->id,
        ]);

        $response->assertSessionHas('error');
    }

    public function test_adding_valid_size_variant_to_cart_succeeds(): void
    {
        $product = Product::where('slug', 'kemeja-oxford-blue')->with('variants')->firstOrFail();
        $inStockVariant = $product->variants->first(fn ($v) => $v->stock > 0);

        $this->assertNotNull($inStockVariant);

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
            'size' => $inStockVariant->size,
            'variant_id' => $inStockVariant->id,
        ]);

        $response->assertSessionHas('success');

        $cart = session('shopping_cart');
        $itemKey = $product->id.'_'.$inStockVariant->id;

        $this->assertArrayHasKey($itemKey, $cart);
        $this->assertEquals($inStockVariant->size, $cart[$itemKey]['size']);
        $this->assertEquals(2, $cart[$itemKey]['quantity']);
    }

    public function test_cart_and_checkout_display_selected_size(): void
    {
        $product = Product::where('slug', 'kemeja-oxford-blue')->with('variants')->firstOrFail();
        $variant = $product->variants->first(fn ($v) => $v->stock > 0);

        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
            'size' => $variant->size,
            'variant_id' => $variant->id,
        ]);

        $cartResponse = $this->get(route('cart.index'));
        $cartResponse->assertStatus(200);
        $cartResponse->assertSee('Ukuran:');
        $cartResponse->assertSee($variant->size);

        $checkoutResponse = $this->get(route('checkout.index'));
        $checkoutResponse->assertStatus(200);
        $checkoutResponse->assertSee('Ukuran: '.$variant->size);
    }

    public function test_order_placement_reduces_variant_stock_in_database(): void
    {
        $product = Product::where('slug', 'kemeja-oxford-blue')->with('variants')->firstOrFail();
        $variant = $product->variants->first(fn ($v) => $v->stock >= 2);

        $initialVariantStock = $variant->stock;
        $initialProductStock = $product->stock;

        $this->post(route('cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
            'size' => $variant->size,
            'variant_id' => $variant->id,
        ]);

        $orderData = [
            'name' => 'Budi Santoso',
            'phone' => '081234567890',
            'address' => 'Jl. Sudirman No. 12',
            'province' => 'DKI Jakarta',
            'city' => 'Jakarta Selatan',
            'district' => 'Kebayoran Baru',
            'kelurahan' => 'Senayan',
            'postal_code' => '12190',
            'shipping' => 'standard',
            'payment' => 'bank_transfer',
        ];

        $checkoutResponse = $this->post(route('checkout.store'), $orderData);
        $checkoutResponse->assertStatus(302);

        // Verify stock in database has been decremented
        $variant->refresh();
        $product->refresh();

        $this->assertEquals($initialVariantStock - 2, $variant->stock);
        $this->assertEquals($initialProductStock - 2, $product->stock);
    }

    public function test_admin_can_view_product_variants_page(): void
    {
        $product = Product::where('slug', 'kemeja-oxford-blue')->firstOrFail();

        $response = $this->get(route('admin.products.variants.index', $product->id));
        $response->assertStatus(200);
        $response->assertSee('Daftar Variasi Ukuran Produk');
        $response->assertSee($product->name);
    }

    public function test_admin_can_add_edit_and_delete_size_variant(): void
    {
        $product = Product::where('slug', 'dompet-kulit-compact')->firstOrFail();

        // 1. Admin adds new variant
        $addResponse = $this->post(route('admin.products.variants.store', $product->id), [
            'size' => 'STANDARD',
            'stock' => 20,
            'additional_price' => 5000,
            'sku' => 'DKC-STD',
        ]);
        $addResponse->assertSessionHas('success');

        $variant = ProductVariant::where('product_id', $product->id)->where('size', 'STANDARD')->first();
        $this->assertNotNull($variant);
        $this->assertEquals(20, $variant->stock);
        $this->assertEquals(5000, $variant->additional_price);

        // 2. Admin updates variant
        $updateResponse = $this->put(route('admin.variants.update', $variant->id), [
            'size' => 'STANDARD',
            'stock' => 15,
            'additional_price' => 10000,
            'sku' => 'DKC-STD-UPDATED',
        ]);
        $updateResponse->assertSessionHas('success');

        $variant->refresh();
        $this->assertEquals(15, $variant->stock);
        $this->assertEquals(10000, $variant->additional_price);

        // 3. Admin deletes variant
        $deleteResponse = $this->delete(route('admin.variants.destroy', $variant->id));
        $deleteResponse->assertSessionHas('success');

        $this->assertNull(ProductVariant::find($variant->id));
    }

    public function test_admin_can_apply_presets(): void
    {
        $product = Product::where('slug', 'dompet-kulit-compact')->firstOrFail();

        // Apply clothing preset
        $response = $this->post(route('admin.products.variants.preset', $product->id), [
            'preset' => 'clothing',
        ]);
        $response->assertSessionHas('success');

        $this->assertEquals(5, $product->variants()->count());

        // Clear preset
        $clearResponse = $this->post(route('admin.products.variants.preset', $product->id), [
            'preset' => 'clear',
        ]);
        $clearResponse->assertSessionHas('success');

        $this->assertEquals(0, $product->variants()->count());
    }
}
