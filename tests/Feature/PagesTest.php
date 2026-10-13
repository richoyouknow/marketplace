<?php

namespace Tests\Feature;

use Tests\TestCase;

class PagesTest extends TestCase
{
    public function test_terms_page_loads_successfully(): void
    {
        $response = $this->get(route('terms'));
        $response->assertStatus(200);
        $response->assertSee('Syarat dan Ketentuan');

        $redirect = $this->get('/terms');
        $redirect->assertRedirect('/syarat-ketentuan');
    }

    public function test_privacy_page_loads_successfully(): void
    {
        $response = $this->get(route('privacy'));
        $response->assertStatus(200);
        $response->assertSee('Kebijakan Privasi');

        $redirect = $this->get('/privacy');
        $redirect->assertRedirect('/kebijakan-privasi');
    }

    public function test_refund_page_loads_successfully(): void
    {
        $response = $this->get(route('refund'));
        $response->assertStatus(200);
        $response->assertSee('Kebijakan Refund');

        $redirect = $this->get('/refund');
        $redirect->assertRedirect('/kebijakan-refund');
    }

    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get(route('about'));
        $response->assertStatus(200);
        $response->assertSee('Tentang Kami');

        $redirect = $this->get('/about');
        $redirect->assertRedirect('/tentang-kami');
    }

    public function test_contact_page_loads_successfully(): void
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);
        $response->assertSee('Hubungi Tim Odaplace');

        $redirect = $this->get('/contact');
        $redirect->assertRedirect('/kontak');
    }

    public function test_contact_form_submission_success(): void
    {
        $payload = [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567890',
            'subject' => 'Pertanyaan Pesanan & Pengiriman',
            'message' => 'Halo tim Odaplace, saya ingin menanyakan status pesanan saya.',
        ];

        $response = $this->post(route('contact.send'), $payload);
        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_help_page_loads_successfully(): void
    {
        $response = $this->get(route('help'));
        $response->assertStatus(200);
        $response->assertSee('Pusat bantuan Odaplace');
        $response->assertSee('Ada yang bisa kami bantu?');
    }
}
