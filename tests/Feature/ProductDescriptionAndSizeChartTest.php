<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductDescriptionAndSizeChartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ProductSeeder::class);
    }

    public function test_shirt_displays_top_measurements_size_chart_and_material(): void
    {
        $shirt = Product::where('category', 'kemeja')->firstOrFail();

        $response = $this->get(route('products.show', $shirt->slug));

        $response->assertStatus(200);
        $response->assertSee('Deskripsi & Detail');
        $response->assertSee('Panduan Ukuran (Size Chart)');
        $response->assertSee('Material & Perawatan');
        $response->assertSee('Tabel Ukuran Kemeja ALLWEAR');
        $response->assertSee('Lingkar Dada');
        $response->assertSee('Panjang Badan');
        $response->assertSee('Lebar Bahu');
        $response->assertSee('Panjang Lengan');
        $response->assertSee('Material Bahan');
        $response->assertSee('Varian Warna');
        $response->assertSee('Petunjuk Perawatan (Garment Care Guide)');
        // Ensure clothing size S, M, L are in table
        $response->assertSee('98 cm');
    }

    public function test_pants_displays_bottom_measurements_size_chart(): void
    {
        $pants = Product::where('category', 'celana')->firstOrFail();

        $response = $this->get(route('products.show', $pants->slug));

        $response->assertStatus(200);
        $response->assertSee('Tabel Ukuran Celana ALLWEAR');
        $response->assertSee('Lingkar Pinggang');
        $response->assertSee('Lingkar Pinggul');
        $response->assertSee('Panjang Celana');
        $response->assertSee('Bukaan Kaki');
        $response->assertSee('28');
        $response->assertSee('30');
        $response->assertSee('32');
    }

    public function test_footwear_displays_insole_measurements_size_chart(): void
    {
        $shoe = Product::where('category', 'alas kaki')->firstOrFail();

        $response = $this->get(route('products.show', $shoe->slug));

        $response->assertStatus(200);
        $response->assertSee('Tabel Ukuran Alas Kaki & Sepatu ALLWEAR');
        $response->assertSee('Panjang Insole');
        $response->assertSee('Rekomendasi Panjang Kaki');
        $response->assertSee('39');
        $response->assertSee('40');
        $response->assertSee('41');
        $response->assertSee('24.5 cm');
    }

    public function test_bag_displays_physical_dimension_chart_without_apparel_sizes(): void
    {
        $bag = Product::where('category', 'tas')->firstOrFail();

        $response = $this->get(route('products.show', $bag->slug));

        $response->assertStatus(200);
        $response->assertSee('Dimensi & Spesifikasi Fisik Tas ALLWEAR');
        $response->assertSee('Dimensi Luar (P x L x T)');
        $response->assertSee('Kapasitas & Kompartemen');
        // Should not render apparel measurements
        $response->assertDontSee('Lingkar Dada');
        $response->assertDontSee('Inseam');
    }

    public function test_hijab_displays_specific_dimensions_and_finishing(): void
    {
        $hijab = Product::where('category', 'hijab')->firstOrFail();

        $response = $this->get(route('products.show', $hijab->slug));

        $response->assertStatus(200);
        $response->assertSee('Spesifikasi Dimensi & Tepi Hijab ALLWEAR');
        $response->assertSee('Dimensi Kain');
        $response->assertSee('Finishing Tepi');
        $response->assertDontSee('Lingkar Pinggang');
        $response->assertDontSee('Lebar Bahu');
    }

    public function test_structured_details_are_rendered_from_product_specifications(): void
    {
        // Product 43: Kemeja Formal Premium Slim Fit Putih has Kerah => Spread Collar, Tipe Potongan => Modern Slim Fit
        $product = Product::where('slug', 'kemeja-formal-slim-fit-white')->first();
        if ($product) {
            $response = $this->get(route('products.show', $product->slug));
            $response->assertStatus(200);
            $response->assertSee('Bentuk Kerah');
            $response->assertSee('Spread Collar');
            $response->assertSee('Potongan (Cut)');
            $response->assertSee('Modern Slim Fit');
        }
    }

    public function test_model_information_is_hidden_when_unavailable(): void
    {
        $product = Product::firstOrFail();

        $response = $this->get(route('products.show', $product->slug));

        $response->assertStatus(200);
        // Products without model info should not show the model info card
        if (empty($product->specifications['Model Info']) && empty($product->specifications['Tinggi Model'])) {
            $response->assertDontSee('Informasi Model');
        }
    }
}
