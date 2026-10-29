<?php

namespace App\Services;

class ProductDetailService
{
    /**
     * Enrich product data with structured details, size chart, material, color, and care guidelines.
     */
    public function enrichProduct(array $product): array
    {
        $specifications = $product['specifications'] ?? [];
        $category = strtolower((string) ($product['category'] ?? ''));

        $product['material'] = $specifications['Bahan'] ?? null;
        $product['color'] = $specifications['Warna'] ?? null;
        $product['model_info'] = $this->extractModelInfo($product);
        $product['structured_details'] = $this->extractStructuredDetails($product);
        $product['size_chart'] = $this->buildSizeChart($product);
        $product['care_instructions'] = $this->buildCareInstructions($product['material'] ?? '');
        $product['additional_notes'] = $this->buildAdditionalNotes($category);

        return $product;
    }

    /**
     * Extract model information only if verified/available in the data.
     * Never fabricates unverified model information.
     */
    protected function extractModelInfo(array $product): ?string
    {
        $specs = $product['specifications'] ?? [];

        foreach (['Model Info', 'Informasi Model', 'Tinggi Model', 'Ukuran Model'] as $key) {
            if (! empty($specs[$key])) {
                return (string) $specs[$key];
            }
        }

        if (! empty($product['model_info'])) {
            return (string) $product['model_info'];
        }

        return null;
    }

    /**
     * Extract structured product details from specifications and characteristics.
     *
     * @return array<string, string>
     */
    protected function extractStructuredDetails(array $product): array
    {
        $specs = $product['specifications'] ?? [];
        $details = [];

        $specMapping = [
            'Model' => 'Model & Siluet',
            'Tipe Potongan' => 'Potongan (Cut)',
            'Fit' => 'Karakter Fit',
            'Desain' => 'Desain Khusus',
            'Kerah' => 'Bentuk Kerah',
            'Lengan' => 'Detail Lengan',
            'Kancing' => 'Detail Kancing',
            'Ritsleting' => 'Ritsleting (Zipper)',
            'Pengunci' => 'Mekanisme Pengunci',
            'Saku' => 'Detail Saku',
            'Kompartemen' => 'Kompartemen',
            'Kompartemen Laptop' => 'Slot Laptop',
            'Slot' => 'Kapasitas Slot',
            'Furing' => 'Lapisan Dalam (Furing)',
            'Jahitan' => 'Teknik Jahitan',
            'Finishing' => 'Finishing Tepi',
            'Belahan' => 'Aksen Belahan (Slit)',
            'Karakter' => 'Karakter Bahan',
            'Ketahanan' => 'Ketahanan Material',
            'Tinggi sol' => 'Tinggi Sol',
            'Tinggi Heels' => 'Tinggi Hak (Heels)',
            'Insole' => 'Teknologi Insole',
            'Panjang Baju' => 'Panjang Baju',
            'Detail' => 'Detail Konstruksi',
            'Fitur' => 'Fitur Utama',
        ];

        foreach ($specMapping as $specKey => $label) {
            if (! empty($specs[$specKey])) {
                $details[$label] = (string) $specs[$specKey];
            }
        }

        return $details;
    }

    /**
     * Build dynamic size chart based on category and available variants.
     */
    public function buildSizeChart(array $product): ?array
    {
        $category = strtolower((string) ($product['category'] ?? ''));
        $variants = $product['variants'] ?? [];
        $variantSizes = collect($variants)->pluck('size')->filter()->values()->all();
        $specs = $product['specifications'] ?? [];

        switch ($category) {
            case 'kemeja':
                return $this->buildShirtSizeChart($variantSizes, $specs);

            case 'kaos':
                return $this->buildTshirtSizeChart($variantSizes, $specs);

            case 'outer':
            case 'sweater':
                return $this->buildOuterSizeChart($variantSizes, $specs);

            case 'blouse':
                return $this->buildBlouseSizeChart($variantSizes, $specs);

            case 'dress':
                return $this->buildDressSizeChart($variantSizes, $specs);

            case 'celana':
                return $this->buildPantsSizeChart($variantSizes, $specs);

            case 'rok':
                return $this->buildSkirtSizeChart($variantSizes, $specs);

            case 'alas kaki':
                return $this->buildFootwearSizeChart($variantSizes, $specs);

            case 'tas':
                return $this->buildBagDimensionChart($specs);

            case 'hijab':
                return $this->buildHijabDimensionChart($specs);

            case 'aksesoris':
                return $this->buildAccessoryDimensionChart($specs);

            default:
                if (! empty($specs['Ukuran']) || ! empty($specs['Dimensi'])) {
                    return [
                        'title' => 'Panduan Dimensi Produk',
                        'type' => 'dimension',
                        'category' => $category,
                        'headers' => ['Parameter', 'Keterangan'],
                        'rows' => [
                            [
                                'size' => 'Ukuran Fisik',
                                'values' => [$specs['Dimensi'] ?? $specs['Ukuran']],
                            ],
                        ],
                        'notes' => 'Pengukuran dilakukan secara manual pada produk fisik.',
                        'guide' => null,
                    ];
                }

                return null;
        }
    }

    protected function buildShirtSizeChart(array $availableSizes, array $specs): array
    {
        $allSizes = [
            'S' => ['Lingkar Dada' => '98 cm', 'Panjang Badan' => '70 cm', 'Lebar Bahu' => '44 cm', 'Panjang Lengan' => '23 / 59 cm'],
            'M' => ['Lingkar Dada' => '102 cm', 'Panjang Badan' => '72 cm', 'Lebar Bahu' => '46 cm', 'Panjang Lengan' => '24 / 60 cm'],
            'L' => ['Lingkar Dada' => '106 cm', 'Panjang Badan' => '74 cm', 'Lebar Bahu' => '48 cm', 'Panjang Lengan' => '25 / 61 cm'],
            'XL' => ['Lingkar Dada' => '112 cm', 'Panjang Badan' => '76 cm', 'Lebar Bahu' => '50 cm', 'Panjang Lengan' => '26 / 62 cm'],
            'XXL' => ['Lingkar Dada' => '118 cm', 'Panjang Badan' => '78 cm', 'Lebar Bahu' => '52 cm', 'Panjang Lengan' => '27 / 63 cm'],
        ];

        $headers = ['Ukuran', 'Lingkar Dada', 'Panjang Badan', 'Lebar Bahu', 'Panjang Lengan'];
        $rows = $this->filterRowsByAvailableSizes($allSizes, $availableSizes);

        return [
            'title' => 'Tabel Ukuran Kemeja ALLWEAR',
            'type' => 'apparel',
            'category' => 'kemeja',
            'headers' => $headers,
            'rows' => $rows,
            'notes' => 'Toleransi ukuran ±1-2 cm wajar terjadi karena proses penjahitan dan produksi massal.',
            'guide' => 'Lingkar dada diukur dari bawah ketiak melingkari bagian dada terluas. Panjang badan diukur dari titik bahu tertinggi hingga ujung bawah kelim.',
        ];
    }

    protected function buildTshirtSizeChart(array $availableSizes, array $specs): array
    {
        $allSizes = [
            'S' => ['Lingkar Dada' => '96 cm', 'Panjang Badan' => '68 cm', 'Lebar Bahu' => '43 cm', 'Panjang Lengan' => '21 cm'],
            'M' => ['Lingkar Dada' => '100 cm', 'Panjang Badan' => '70 cm', 'Lebar Bahu' => '45 cm', 'Panjang Lengan' => '22 cm'],
            'L' => ['Lingkar Dada' => '106 cm', 'Panjang Badan' => '72 cm', 'Lebar Bahu' => '47 cm', 'Panjang Lengan' => '23 cm'],
            'XL' => ['Lingkar Dada' => '112 cm', 'Panjang Badan' => '74 cm', 'Lebar Bahu' => '49 cm', 'Panjang Lengan' => '24 cm'],
            'XXL' => ['Lingkar Dada' => '118 cm', 'Panjang Badan' => '76 cm', 'Lebar Bahu' => '51 cm', 'Panjang Lengan' => '25 cm'],
        ];

        $headers = ['Ukuran', 'Lingkar Dada', 'Panjang Badan', 'Lebar Bahu', 'Panjang Lengan'];
        $rows = $this->filterRowsByAvailableSizes($allSizes, $availableSizes);

        return [
            'title' => 'Tabel Ukuran Kaos & T-Shirt ALLWEAR',
            'type' => 'apparel',
            'category' => 'kaos',
            'headers' => $headers,
            'rows' => $rows,
            'notes' => 'Toleransi ukuran ±1-2 cm wajar terjadi pada kain rajut katun alami.',
            'guide' => 'Lebar bahu diukur lurus dari jahitan ujung pundak kiri ke pundak kanan. Lingkar dada diukur melingkari dada secara rata.',
        ];
    }

    protected function buildOuterSizeChart(array $availableSizes, array $specs): array
    {
        $allSizes = [
            'S' => ['Lingkar Dada' => '104 cm', 'Panjang Badan' => '66 cm', 'Lebar Bahu' => '46 cm', 'Panjang Lengan' => '58 cm'],
            'M' => ['Lingkar Dada' => '110 cm', 'Panjang Badan' => '68 cm', 'Lebar Bahu' => '48 cm', 'Panjang Lengan' => '60 cm'],
            'L' => ['Lingkar Dada' => '116 cm', 'Panjang Badan' => '70 cm', 'Lebar Bahu' => '50 cm', 'Panjang Lengan' => '62 cm'],
            'XL' => ['Lingkar Dada' => '122 cm', 'Panjang Badan' => '72 cm', 'Lebar Bahu' => '52 cm', 'Panjang Lengan' => '64 cm'],
            'XXL' => ['Lingkar Dada' => '128 cm', 'Panjang Badan' => '74 cm', 'Lebar Bahu' => '54 cm', 'Panjang Lengan' => '65 cm'],
        ];

        $headers = ['Ukuran', 'Lingkar Dada', 'Panjang Badan', 'Lebar Bahu', 'Panjang Lengan'];
        $rows = $this->filterRowsByAvailableSizes($allSizes, $availableSizes);

        if (empty($rows)) {
            $ukuran = $specs['Ukuran'] ?? 'All Size';
            $rows = [
                [
                    'size' => $ukuran,
                    'values' => ['106 - 114 cm', '65 - 68 cm', '48 - 50 cm', '56 - 60 cm'],
                ],
            ];
        }

        return [
            'title' => 'Tabel Ukuran Jaket, Hoodie & Outer ALLWEAR',
            'type' => 'apparel',
            'category' => 'outer',
            'headers' => $headers,
            'rows' => $rows,
            'notes' => 'Ukuran outer dirancang dengan ruang ekstra (loose fit) untuk kenyamanan saat layering di atas kaos atau kemeja.',
            'guide' => 'Panjang lengan diukur dari jahitan puncak bahu hingga ujung manset pergelangan tangan.',
        ];
    }

    protected function buildBlouseSizeChart(array $availableSizes, array $specs): array
    {
        $panjangBaju = $specs['Panjang Baju'] ?? null;

        $allSizes = [
            'S' => ['Lingkar Dada' => '92 cm', 'Panjang Baju' => $panjangBaju ?? '64 cm', 'Lebar Bahu' => '37 cm', 'Panjang Lengan' => '54 cm'],
            'M' => ['Lingkar Dada' => '96 cm', 'Panjang Baju' => $panjangBaju ?? '66 cm', 'Lebar Bahu' => '38 cm', 'Panjang Lengan' => '55 cm'],
            'L' => ['Lingkar Dada' => '102 cm', 'Panjang Baju' => $panjangBaju ?? '68 cm', 'Lebar Bahu' => '40 cm', 'Panjang Lengan' => '56 cm'],
            'XL' => ['Lingkar Dada' => '108 cm', 'Panjang Baju' => $panjangBaju ?? '70 cm', 'Lebar Bahu' => '42 cm', 'Panjang Lengan' => '57 cm'],
            'XXL' => ['Lingkar Dada' => '114 cm', 'Panjang Baju' => $panjangBaju ?? '72 cm', 'Lebar Bahu' => '44 cm', 'Panjang Lengan' => '58 cm'],
        ];

        $headers = ['Ukuran', 'Lingkar Dada', 'Panjang Baju', 'Lebar Bahu', 'Panjang Lengan'];
        $rows = $this->filterRowsByAvailableSizes($allSizes, $availableSizes);

        if (empty($rows)) {
            $rows = [
                [
                    'size' => $specs['Ukuran'] ?? 'All Size',
                    'values' => ['98 - 104 cm', $panjangBaju ?? '68 cm', '39 cm', '55 cm'],
                ],
            ];
        }

        return [
            'title' => 'Tabel Ukuran Blouse & Tunik ALLWEAR',
            'type' => 'apparel',
            'category' => 'blouse',
            'headers' => $headers,
            'rows' => $rows,
            'notes' => 'Toleransi ukuran ±1-2 cm wajar terjadi karena proses pemotongan dan penjahitan butik.',
            'guide' => 'Lingkar dada diukur pada bagian dada paling penuh tanpa menarik pita ukur terlalu kencang.',
        ];
    }

    protected function buildDressSizeChart(array $availableSizes, array $specs): array
    {
        $panjangDress = $specs['Panjang'] ?? null;
        $lingkarDadaSpec = $specs['Lingkar Dada'] ?? null;

        $allSizes = [
            'S' => ['Lingkar Dada' => '90 cm', 'Panjang Dress' => $panjangDress ?? '115 cm', 'Lingkar Pinggang' => '72 cm', 'Panjang Lengan' => '54 cm'],
            'M' => ['Lingkar Dada' => '96 cm', 'Panjang Dress' => $panjangDress ?? '118 cm', 'Lingkar Pinggang' => '76 cm', 'Panjang Lengan' => '55 cm'],
            'L' => ['Lingkar Dada' => '102 cm', 'Panjang Dress' => $panjangDress ?? '120 cm', 'Lingkar Pinggang' => '82 cm', 'Panjang Lengan' => '56 cm'],
            'XL' => ['Lingkar Dada' => '108 cm', 'Panjang Dress' => $panjangDress ?? '122 cm', 'Lingkar Pinggang' => '88 cm', 'Panjang Lengan' => '57 cm'],
        ];

        $headers = ['Ukuran', 'Lingkar Dada', 'Panjang Dress', 'Lingkar Pinggang', 'Panjang Lengan'];
        $rows = $this->filterRowsByAvailableSizes($allSizes, $availableSizes);

        if (empty($rows)) {
            $rows = [
                [
                    'size' => $specs['Ukuran'] ?? 'All Size',
                    'values' => [
                        $lingkarDadaSpec ?? '104 - 110 cm',
                        $panjangDress ?? '138 - 140 cm',
                        'Elastis / Flowy',
                        '56 - 58 cm',
                    ],
                ],
            ];
        }

        return [
            'title' => 'Tabel Ukuran Dress & Gamis ALLWEAR',
            'type' => 'apparel',
            'category' => 'dress',
            'headers' => $headers,
            'rows' => $rows,
            'notes' => 'Toleransi jahitan ±1-2 cm wajar terjadi pada material kain flowy.',
            'guide' => 'Panjang dress diukur lurus dari titik bahu tertinggi vertikal hingga ujung bawah gaun.',
        ];
    }

    protected function buildPantsSizeChart(array $availableSizes, array $specs): array
    {
        $allSizes = [
            '28' => ['Lingkar Pinggang' => '74 cm', 'Lingkar Pinggul' => '92 cm', 'Panjang Celana' => '98 cm', 'Inseam' => '72 cm', 'Bukaan Kaki' => '34 cm'],
            '30' => ['Lingkar Pinggang' => '78 cm', 'Lingkar Pinggul' => '96 cm', 'Panjang Celana' => '100 cm', 'Inseam' => '73 cm', 'Bukaan Kaki' => '36 cm'],
            '32' => ['Lingkar Pinggang' => '84 cm', 'Lingkar Pinggul' => '102 cm', 'Panjang Celana' => '101 cm', 'Inseam' => '74 cm', 'Bukaan Kaki' => '38 cm'],
            '34' => ['Lingkar Pinggang' => '88 cm', 'Lingkar Pinggul' => '106 cm', 'Panjang Celana' => '102 cm', 'Inseam' => '75 cm', 'Bukaan Kaki' => '40 cm'],
            '36' => ['Lingkar Pinggang' => '94 cm', 'Lingkar Pinggul' => '112 cm', 'Panjang Celana' => '103 cm', 'Inseam' => '76 cm', 'Bukaan Kaki' => '42 cm'],
            '38' => ['Lingkar Pinggang' => '98 cm', 'Lingkar Pinggul' => '116 cm', 'Panjang Celana' => '104 cm', 'Inseam' => '77 cm', 'Bukaan Kaki' => '44 cm'],
        ];

        $headers = ['Ukuran (Waist)', 'Lingkar Pinggang', 'Lingkar Pinggul', 'Panjang Celana', 'Inseam', 'Bukaan Kaki'];
        $rows = $this->filterRowsByAvailableSizes($allSizes, $availableSizes);

        return [
            'title' => 'Tabel Ukuran Celana ALLWEAR',
            'type' => 'bottom',
            'category' => 'celana',
            'headers' => $headers,
            'rows' => $rows,
            'notes' => 'Toleransi ukuran ±1-2 cm wajar terjadi. Untuk celana berbahan stretch, bahan dapat meregang 2-3 cm saat dipakai.',
            'guide' => 'Lingkar pinggang diukur mendatar di tempat sabuk bertumpu. Inseam diukur dari pangkal selangkangan hingga batas bawah ujung celana.',
        ];
    }

    protected function buildSkirtSizeChart(array $availableSizes, array $specs): array
    {
        $allSizes = [
            'S' => ['Lingkar Pinggang' => '64 - 70 cm', 'Lingkar Pinggul' => '90 cm', 'Panjang Rok' => '85 cm', 'Lebar Bawah' => '120 cm'],
            'M' => ['Lingkar Pinggang' => '68 - 76 cm', 'Lingkar Pinggul' => '95 cm', 'Panjang Rok' => '86 cm', 'Lebar Bawah' => '124 cm'],
            'L' => ['Lingkar Pinggang' => '72 - 82 cm', 'Lingkar Pinggul' => '100 cm', 'Panjang Rok' => '87 cm', 'Lebar Bawah' => '128 cm'],
            'XL' => ['Lingkar Pinggang' => '76 - 88 cm', 'Lingkar Pinggul' => '106 cm', 'Panjang Rok' => '88 cm', 'Lebar Bawah' => '132 cm'],
        ];

        $headers = ['Ukuran', 'Lingkar Pinggang', 'Lingkar Pinggul', 'Panjang Rok', 'Lebar Bawah'];
        $rows = $this->filterRowsByAvailableSizes($allSizes, $availableSizes);

        if (empty($rows)) {
            $rows = [
                [
                    'size' => $specs['Ukuran'] ?? 'All Size',
                    'values' => [
                        '64 - 96 cm (Karet Elastis)',
                        '92 - 108 cm',
                        $specs['Panjang'] ?? '85 cm',
                        'Mengikuti Potongan (A-Line / Span)',
                    ],
                ],
            ];
        }

        return [
            'title' => 'Tabel Ukuran Rok ALLWEAR',
            'type' => 'bottom',
            'category' => 'rok',
            'headers' => $headers,
            'rows' => $rows,
            'notes' => 'Toleransi ukuran ±1-2 cm wajar terjadi karena proses penjahitan dan elastisitas pinggang karet.',
            'guide' => 'Lingkar pinggang diukur dari titik ban pinggang alami dalam kondisi relaks hingga tarikan optimal.',
        ];
    }

    protected function buildFootwearSizeChart(array $availableSizes, array $specs): array
    {
        $allSizes = [
            '36' => ['Panjang Insole' => '23.0 cm', 'Rekomendasi Panjang Telapak' => '22.5 cm'],
            '37' => ['Panjang Insole' => '23.5 cm', 'Rekomendasi Panjang Telapak' => '23.0 cm'],
            '38' => ['Panjang Insole' => '24.0 cm', 'Rekomendasi Panjang Telapak' => '23.5 cm'],
            '39' => ['Panjang Insole' => '24.5 cm', 'Rekomendasi Panjang Telapak' => '24.0 cm'],
            '40' => ['Panjang Insole' => '25.0 cm', 'Rekomendasi Panjang Telapak' => '24.5 cm'],
            '41' => ['Panjang Insole' => '25.5 cm', 'Rekomendasi Panjang Telapak' => '25.0 cm'],
            '42' => ['Panjang Insole' => '26.5 cm', 'Rekomendasi Panjang Telapak' => '26.0 cm'],
            '43' => ['Panjang Insole' => '27.5 cm', 'Rekomendasi Panjang Telapak' => '27.0 cm'],
            '44' => ['Panjang Insole' => '28.0 cm', 'Rekomendasi Panjang Telapak' => '27.5 cm'],
        ];

        $headers = ['Ukuran (EU)', 'Panjang Insole (cm)', 'Rekomendasi Panjang Kaki (cm)'];
        $rows = $this->filterRowsByAvailableSizes($allSizes, $availableSizes);

        return [
            'title' => 'Tabel Ukuran Alas Kaki & Sepatu ALLWEAR',
            'type' => 'footwear',
            'category' => 'alas kaki',
            'headers' => $headers,
            'rows' => $rows,
            'notes' => 'Ukur panjang telapak kaki dari tumit belakang hingga ujung jempol terpanjang. Jika tipe telapak kaki lebar, kami sarankan naik 1 nomor (upsize).',
            'guide' => 'Letakkan kaki di atas selembar kertas, beri tanda pada tumit dan ujung jari terpanjang, lalu ukur jaraknya dengan penggaris.',
        ];
    }

    protected function buildBagDimensionChart(array $specs): array
    {
        $dimension = $specs['Dimensi'] ?? $specs['Ukuran'] ?? 'Standard Compact';
        $kompartemen = $specs['Kompartemen'] ?? 'Kompartemen utama dengan saku fungsional';
        $laptop = $specs['Kompartemen Laptop'] ?? null;
        $bahan = $specs['Bahan'] ?? 'Bahan berkualitas tinggi';

        $rows = [
            ['size' => 'Dimensi Luar (P x L x T)', 'values' => [$dimension]],
            ['size' => 'Kapasitas & Kompartemen', 'values' => [$kompartemen]],
        ];

        if ($laptop) {
            $rows[] = ['size' => 'Kompartemen Laptop', 'values' => [$laptop]];
        }

        if (! empty($specs['Fitur'])) {
            $rows[] = ['size' => 'Fitur Mobilitas', 'values' => [$specs['Fitur']]];
        }

        $rows[] = ['size' => 'Material Konstruksi', 'values' => [$bahan]];

        return [
            'title' => 'Dimensi & Spesifikasi Fisik Tas ALLWEAR',
            'type' => 'dimension',
            'category' => 'tas',
            'headers' => ['Parameter Spesifikasi', 'Keterangan'],
            'rows' => $rows,
            'notes' => 'Dimensi diukur pada volume terluar tas dalam kondisi terisi normal. Toleransi selisih 0.5-1 cm wajar terjadi.',
            'guide' => 'Pastikan ukuran barang bawaan Anda (laptop/dokumen/gadget) tidak melebihi dimensi internal kompartemen.',
        ];
    }

    protected function buildHijabDimensionChart(array $specs): array
    {
        $dimension = $specs['Ukuran'] ?? $specs['Dimensi'] ?? '115 x 115 cm';
        $finishing = $specs['Finishing'] ?? $specs['Jahitan'] ?? 'Jahit tepi rapi kualitas butik';
        $karakter = $specs['Karakter'] ?? 'Halus, mudah dibentuk, tidak mudah bergeser';
        $bahan = $specs['Bahan'] ?? 'Voal Ultrafine';

        $rows = [
            ['size' => 'Dimensi Kain', 'values' => [$dimension]],
            ['size' => 'Finishing Tepi', 'values' => [$finishing]],
            ['size' => 'Karakteristik Bahan', 'values' => [$karakter]],
            ['size' => 'Material Kain', 'values' => [$bahan]],
        ];

        return [
            'title' => 'Spesifikasi Dimensi & Tepi Hijab ALLWEAR',
            'type' => 'dimension',
            'category' => 'hijab',
            'headers' => ['Aspek Produk', 'Detail Spesifikasi'],
            'rows' => $rows,
            'notes' => 'Kain dipotong dan dineci/dijahit dengan presisi tinggi. Toleransi ukuran ±1-2 cm wajar terjadi pada bentang kain.',
            'guide' => 'Untuk hijab segi empat, lipat menjadi segitiga sama sisi. Untuk model pashmina, sesuaikan sisi panjang untuk kreasi layer.',
        ];
    }

    protected function buildAccessoryDimensionChart(array $specs): array
    {
        $dimension = $specs['Dimensi'] ?? $specs['Ukuran'] ?? $specs['Panjang'] ?? 'Ukuran standar kompak';
        $slot = $specs['Slot'] ?? null;
        $pengunci = $specs['Pengunci'] ?? null;
        $bahan = $specs['Bahan'] ?? 'Material teruji';

        $rows = [
            ['size' => 'Dimensi Fisik', 'values' => [$dimension]],
        ];

        if ($slot) {
            $rows[] = ['size' => 'Kapasitas Slot / Sekat', 'values' => [$slot]];
        }

        if ($pengunci) {
            $rows[] = ['size' => 'Mekanisme Pengunci', 'values' => [$pengunci]];
        }

        $rows[] = ['size' => 'Material Dasar', 'values' => [$bahan]];

        return [
            'title' => 'Dimensi & Detail Fisik Aksesoris ALLWEAR',
            'type' => 'dimension',
            'category' => 'aksesoris',
            'headers' => ['Parameter Fisik', 'Spesifikasi Produk'],
            'rows' => $rows,
            'notes' => 'Pengukuran dimensi dilakukan secara presisi dengan jangka sorong/pita ukur.',
            'guide' => 'Simpan di dalam pouch pelindung saat tidak digunakan untuk menjaga ketahanan permukaan material.',
        ];
    }

    /**
     * Filter chart rows so that only sizes available in the product's actual variants are shown.
     */
    protected function filterRowsByAvailableSizes(array $allSizes, array $availableSizes): array
    {
        if (empty($availableSizes)) {
            $rows = [];
            foreach ($allSizes as $size => $measurements) {
                $rows[] = [
                    'size' => (string) $size,
                    'values' => array_values($measurements),
                ];
            }

            return $rows;
        }

        $normalizedAvailable = array_map('strtoupper', array_map('strval', $availableSizes));
        $rows = [];

        foreach ($allSizes as $size => $measurements) {
            if (in_array(strtoupper((string) $size), $normalizedAvailable, true)) {
                $rows[] = [
                    'size' => (string) $size,
                    'values' => array_values($measurements),
                ];
            }
        }

        // If exact match yielded nothing (e.g. numeric or special names), return all sizes
        if (empty($rows)) {
            foreach ($allSizes as $size => $measurements) {
                $rows[] = [
                    'size' => (string) $size,
                    'values' => array_values($measurements),
                ];
            }
        }

        return $rows;
    }

    /**
     * Build care instructions tailored to the product material.
     *
     * @return array<int, string>
     */
    protected function buildCareInstructions(string $material): array
    {
        $matLower = strtolower($material);

        if (str_contains($matLower, 'linen')) {
            return [
                'Gunakan siklus pencucian lembut (gentle cycle) dengan air dingin atau suhu ruang.',
                'Jangan memeras kain terlalu kuat guna menjaga struktur serat linen alami.',
                'Setrika saat kain masih dalam kondisi setengah lembap dengan suhu sedang hingga tinggi.',
                'Simpan dengan gantungan hanger berbusa di tempat yang kering dan berventilasi baik.',
            ];
        }

        if (str_contains($matLower, 'satin') || str_contains($matLower, 'silk')) {
            return [
                'Sangat disarankan mencuci manual menggunakan tangan dengan lembut (hand wash).',
                'Gunakan detergen cair khusus pakaian halus atau sabun berbahan lembut.',
                'Hindari penggunaan mesin pengering (tumble dry) dan perasan keras.',
                'Setrika kain dari sisi bagian dalam dengan pengaturan suhu paling rendah (silk setting).',
            ];
        }

        if (str_contains($matLower, 'knit') || str_contains($matLower, 'rajut') || str_contains($matLower, 'wool')) {
            return [
                'Cuci menggunakan laundry bag jika menggunakan mesin, atau cuci tangan perlahan.',
                'Keringkan secara mendatar (flat dry) di atas permukaan rata agar rajutan tidak melar.',
                'Jangan menyikat permukaan benang rajut untuk mencegah timbulnya gumpalan (pilling).',
                'Gunakan setrika uap (steamer) untuk merapikan serat tanpa menekan langsung ke kain.',
            ];
        }

        if (str_contains($matLower, 'kulit') || str_contains($matLower, 'leather') || str_contains($matLower, 'microfiber')) {
            return [
                'Cukup bersihkan debu dan noda menggunakan lap microfiber yang sedikit dibasahi air.',
                'Hindari mencuci dengan mesin cuci atau merendam produk di dalam air.',
                'Oleskan leather conditioner khusus secara berkala untuk menjaga kelembutan kulit.',
                'Simpan di tempat sejuk dengan sirkulasi udara baik dan hindari paparan sinar matahari langsung.',
            ];
        }

        if (str_contains($matLower, 'fleece')) {
            return [
                'Cuci dengan air dingin dan balikkan pakaian (bagian dalam di luar) saat mencuci.',
                'Hindari pemakaian cairan pelembut pakaian berlebih agar daya serap fleece tetap optimal.',
                'Keringkan dengan cara diangin-anginkan di tempat teduh.',
                'Setrika dengan suhu rendah atau gunakan pelapis kain saat menyetrika.',
            ];
        }

        if (str_contains($matLower, 'voal') || str_contains($matLower, 'ceruty')) {
            return [
                'Cuci tangan secara perlahan tanpa mengucek kain secara kasar.',
                'Gunakan peniti atau jarum pentul berkualitas tajam agar tidak menarik serat benang halus.',
                'Jemur di tempat teduh tanpa terkena matahari terik langsung.',
                'Setrika dengan temperatur rendah hingga sedang untuk menjaga kelembutan kain.',
            ];
        }

        if (str_contains($matLower, 'denim') || str_contains($matLower, 'twill') || str_contains($matLower, 'corduroy')) {
            return [
                'Cuci dengan membalik bagian dalam ke luar untuk melindungi warna asli bahan.',
                'Gunakan air dingin untuk mempertahankan kepadatan serat dan mencegah penyusutan.',
                'Pisahkan dari pakaian berwarna terang saat pencucian awal.',
                'Setrika dengan suhu sedang-panas dari bagian dalam.',
            ];
        }

        // Default cotton / general apparel care
        return [
            'Cuci dengan mesin putaran normal menggunakan air dingin atau suhu maksimal 30°C.',
            'Pisahkan pakaian berwarna gelap dan terang pada pencucian pertama.',
            'Hindari penggunaan pemutih berbahan klorin keras yang dapat merusak serat katun.',
            'Setrika dengan temperatur sedang (medium heat) untuk hasil rapi maksimal.',
        ];
    }

    /**
     * Build additional notes and customer assurances.
     *
     * @return array<int, string>
     */
    protected function buildAdditionalNotes(string $category): array
    {
        $notes = [
            'Toleransi Ukuran: Selisih 1-2 cm dapat terjadi karena proses pemotongan dan penjahitan manual pada produksi massal.',
            'Akurasi Warna: Tingkat kemiripan warna foto produk dengan aslinya mencapai 95-98%, perbedaan minor dapat dipengaruhi oleh pencahayaan studio serta kalibrasi layar gawai Anda.',
            'Garansi ALLWEAR: Tukar ukuran atau klaim cacat produksi berlaku 3 hari kerja setelah paket diterima, dengan syarat menyertakan video unboxing dan label produk belum dilepas.',
        ];

        if ($category === 'alas kaki') {
            array_unshift($notes, 'Panduan Fitting: Jika panjang kaki Anda berada di antara dua ukuran, atau jika memiliki tipe punggung kaki lebar, disarankan memilih 1 ukuran lebih besar.');
        }

        return $notes;
    }
}
