<?php

namespace Tests\Feature;

use Tests\TestCase;

class CheckoutTest extends TestCase
{
    public function test_empty_cart_redirects_to_cart_index(): void
    {
        $response = $this->get(route('checkout.index'));
        $response->assertRedirect(route('cart.index'));
    }

    public function test_checkout_submission_creates_order_and_redirects_to_success(): void
    {
        // Setup cart session
        $dummyCart = [
            1 => [
                'id' => 1,
                'slug' => 'sample-product',
                'name' => 'Sepatu Sneakers Pria',
                'price' => 350000,
                'image' => 'https://via.placeholder.com/150',
                'brand' => 'Aero',
                'stock' => 10,
                'quantity' => 2,
            ],
        ];
        session(['shopping_cart' => $dummyCart]);

        $payload = [
            'name' => 'Ahmad Fauzi',
            'phone' => '081298765432',
            'address' => 'Jl. Kebon Jeruk Raya No. 12 RT 04 RW 02',
            'province' => 'DKI Jakarta',
            'city' => 'Jakarta Barat',
            'district' => 'Kebon Jeruk',
            'kelurahan' => 'Sukabumi Selatan',
            'postal_code' => '11560',
            'notes' => 'Pagar putih, titip di pos',
            'shipping' => 'express',
            'payment' => 'bank_transfer',
        ];

        $response = $this->post(route('checkout.store'), $payload);

        $response->assertRedirect();
        $this->assertStringContainsString('checkout/success?order=', $response->headers->get('Location'));

        // Cart should now be empty
        $this->assertEmpty(session('shopping_cart', []));

        // Placed orders should have the order
        $placedOrders = session('placed_orders', []);
        $this->assertNotEmpty($placedOrders);
        $order = reset($placedOrders);

        $this->assertEquals('Ahmad Fauzi', $order['recipient']['name']);
        $this->assertEquals('11560', $order['recipient']['postal_code']);
        $this->assertEquals(25000, $order['shipping']['cost']);
    }

    public function test_order_detail_page_loads_successfully(): void
    {
        $response = $this->get(route('checkout.order', 'ODA-20261013-TEST1'));

        $response->assertStatus(200);
        $response->assertSee('Detail Pesanan');
        $response->assertSee('Informasi Pengiriman');
        $response->assertSee('Rincian Pembayaran');
    }

    public function test_account_orders_history_page_loads(): void
    {
        $response = $this->get(route('account.orders'));

        $response->assertStatus(200);
        $response->assertSee('Riwayat Pesanan');
    }
}
