<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class OrderService
{
    protected string $sessionKey = 'placed_orders';

    /**
     * Create a new order from checkout submission and save to session.
     */
    public function createOrder(array $data, array $cart, int $subtotal): array
    {
        $today = date('Ymd');
        $randomCode = strtoupper(substr(uniqid(), -5));
        $orderId = 'ODA-'.$today.'-'.$randomCode;
        $invoiceNumber = 'INV/'.$today.'/ODA/'.rand(100000, 999999);

        $shippingFee = ($data['shipping'] === 'express') ? 25000 : 0;
        $serviceFee = 1000;
        $total = $subtotal + $shippingFee + $serviceFee;

        $courierName = match ($data['shipping']) {
            'express' => 'SiCepat BEST / JNE YES (Express)',
            default => 'J&T Express / SiCepat Reguler',
        };

        $etd = match ($data['shipping']) {
            'express' => '1 – 2 Hari Kerja',
            default => '2 – 5 Hari Kerja',
        };

        $paymentInfo = match ($data['payment']) {
            'bank_transfer' => [
                'name' => 'BCA Virtual Account',
                'category' => 'Transfer Bank',
                'code' => '8801'.rand(10000000, 99999999),
                'status' => 'Menunggu Pembayaran',
                'badge_class' => 'bg-amber-50 text-amber-700 border-amber-200',
                'instructions' => 'Salin nomor Virtual Account di atas dan lakukan pembayaran sebelum 24 jam via m-Banking atau ATM.',
            ],
            'e_wallet' => [
                'name' => 'GoPay / OVO / DANA',
                'category' => 'E-Wallet',
                'code' => '0812'.rand(10000000, 99999999),
                'status' => 'Menunggu Pembayaran',
                'badge_class' => 'bg-amber-50 text-amber-700 border-amber-200',
                'instructions' => 'Buka aplikasi e-wallet Anda untuk menyetujui transaksi pembayaran.',
            ],
            'cod' => [
                'name' => 'Bayar di Tempat (COD)',
                'category' => 'COD',
                'code' => null,
                'status' => 'Pesanan Diproses',
                'badge_class' => 'bg-blue-50 text-blue-700 border-blue-200',
                'instructions' => 'Siapkan uang tunai sesuai total tagihan saat kurir mengantarkan pesanan ke alamat Anda.',
            ],
            default => [
                'name' => 'Transfer Bank',
                'category' => 'Transfer Bank',
                'code' => '8801'.rand(10000000, 99999999),
                'status' => 'Menunggu Pembayaran',
                'badge_class' => 'bg-amber-50 text-amber-700 border-amber-200',
                'instructions' => 'Lakukan pembayaran sesuai nominal tepat sebelum batas waktu berakhir.',
            ],
        };

        $order = [
            'id' => $orderId,
            'invoice_number' => $invoiceNumber,
            'created_at' => now()->format('d M Y, H:i').' WIB',
            'deadline' => now()->addDay()->format('d M Y, H:i').' WIB',
            'status' => $paymentInfo['status'],
            'badge_class' => $paymentInfo['badge_class'],
            'recipient' => [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'province' => $data['province'],
                'city' => $data['city'],
                'district' => $data['district'],
                'kelurahan' => $data['kelurahan'] ?? '-',
                'postal_code' => $data['postal_code'],
                'notes' => ! empty($data['notes']) ? $data['notes'] : null,
            ],
            'shipping' => [
                'method' => $data['shipping'] === 'express' ? 'Express' : 'Reguler',
                'courier' => $courierName,
                'etd' => $etd,
                'tracking_number' => 'JP'.rand(1000000000, 9999999999),
                'cost' => $shippingFee,
                'status_tracking' => 'Pesanan telah diverifikasi, penjual sedang menyiapkan paket.',
            ],
            'payment' => [
                'method' => $data['payment'],
                'name' => $paymentInfo['name'],
                'category' => $paymentInfo['category'],
                'code' => $paymentInfo['code'],
                'status' => $paymentInfo['status'],
                'instructions' => $paymentInfo['instructions'],
            ],
            'items' => array_values($cart),
            'pricing' => [
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'service_fee' => $serviceFee,
                'total' => $total,
            ],
        ];

        $orders = Session::get($this->sessionKey, []);
        $orders[$orderId] = $order;
        Session::put($this->sessionKey, $orders);

        return $order;
    }

    /**
     * Retrieve an order by ID from session, or return a sample fallback order.
     */
    public function getOrder(string $orderId): ?array
    {
        $orders = Session::get($this->sessionKey, []);
        if (isset($orders[$orderId])) {
            return $orders[$orderId];
        }

        // Return a realistic sample order if not found
        return $this->getSampleOrder($orderId);
    }

    /**
     * Return all orders (session orders merged with mock demo orders).
     */
    public function getAllOrders(): array
    {
        $sessionOrders = Session::get($this->sessionKey, []);
        $sampleOrders = $this->getDefaultSampleOrders();

        $combined = array_values($sessionOrders);
        foreach ($sampleOrders as $sample) {
            $combined[] = $sample;
        }

        return $combined;
    }

    /**
     * Fallback single sample order generator.
     */
    public function getSampleOrder(string $orderId): array
    {
        return [
            'id' => $orderId,
            'invoice_number' => 'INV/'.date('Ymd').'/ODA/739102',
            'created_at' => now()->subHours(2)->format('d M Y, H:i').' WIB',
            'deadline' => now()->addHours(22)->format('d M Y, H:i').' WIB',
            'status' => 'Pesanan Diproses',
            'badge_class' => 'bg-blue-50 text-blue-700 border-blue-200',
            'recipient' => [
                'name' => 'Budi Santoso',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 45, RT 02 / RW 05, Blok B4',
                'province' => 'Jawa Barat',
                'city' => 'Kota Bandung',
                'district' => 'Coblong',
                'kelurahan' => 'Dago',
                'postal_code' => '40135',
                'notes' => 'Pagar warna hitam, titip di pos keamanan jika sedang keluar.',
            ],
            'shipping' => [
                'method' => 'Reguler',
                'courier' => 'J&T Express / SiCepat Reguler',
                'etd' => '2 – 3 Hari Kerja',
                'tracking_number' => 'JP8829103940',
                'cost' => 0,
                'status_tracking' => 'Paket telah diserahkan ke kurir sortir Jakarta Pusat.',
            ],
            'payment' => [
                'method' => 'bank_transfer',
                'name' => 'BCA Virtual Account',
                'category' => 'Transfer Bank',
                'code' => '88019827361849',
                'status' => 'Sudah Dibayar',
                'instructions' => 'Pembayaran terkonfirmasi otomatis via Virtual Account.',
            ],
            'items' => [
                [
                    'id' => 1,
                    'slug' => 'wireless-headphones',
                    'name' => 'Premium Wireless Noise Cancelling Headphones',
                    'price' => 1250000,
                    'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&q=80',
                    'brand' => 'AudioPro',
                    'quantity' => 1,
                ],
                [
                    'id' => 2,
                    'slug' => 'smart-watch',
                    'name' => 'Fitness Smart Watch Series 5',
                    'price' => 850000,
                    'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80',
                    'brand' => 'TechGear',
                    'quantity' => 1,
                ],
            ],
            'pricing' => [
                'subtotal' => 2100000,
                'shipping_fee' => 0,
                'service_fee' => 1000,
                'total' => 2101000,
            ],
        ];
    }

    /**
     * Default list of orders for order history.
     */
    protected function getDefaultSampleOrders(): array
    {
        return [
            [
                'id' => 'ODA-20261008-88219',
                'invoice_number' => 'INV/20261008/ODA/882190',
                'created_at' => '08 Okt 2026, 14:20 WIB',
                'status' => 'Selesai',
                'badge_class' => 'bg-green-50 text-green-700 border-green-200',
                'shipping' => [
                    'method' => 'Reguler',
                    'courier' => 'J&T Express',
                    'tracking_number' => 'JP2981048201',
                ],
                'payment' => [
                    'name' => 'BCA Virtual Account',
                ],
                'items' => [
                    [
                        'id' => 1,
                        'name' => 'Mechanical Gaming Keyboard RGB',
                        'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=500&q=80',
                        'price' => 750000,
                        'quantity' => 1,
                    ],
                ],
                'pricing' => [
                    'total' => 751000,
                ],
            ],
            [
                'id' => 'ODA-20260921-12048',
                'invoice_number' => 'INV/20260921/ODA/120483',
                'created_at' => '21 Sep 2026, 09:15 WIB',
                'status' => 'Selesai',
                'badge_class' => 'bg-green-50 text-green-700 border-green-200',
                'shipping' => [
                    'method' => 'Express',
                    'courier' => 'SiCepat BEST',
                    'tracking_number' => 'SC9182301928',
                ],
                'payment' => [
                    'name' => 'GoPay',
                ],
                'items' => [
                    [
                        'id' => 2,
                        'name' => 'Ergonomic Vertical Mouse Wireless',
                        'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=500&q=80',
                        'price' => 380000,
                        'quantity' => 1,
                    ],
                ],
                'pricing' => [
                    'total' => 406000,
                ],
            ],
        ];
    }
}
