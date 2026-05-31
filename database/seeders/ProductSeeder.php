<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Rendang Daging Sapi Kemasan - 300g',
                'slug' => 'rendang-kemasan',
                'price' => 95000,
                'weight' => '300 gram',
                'type' => 'Rendang Daging Sapi',
                'packaging' => 'Vacuum pack',
                'shelf_life' => '3-5 hari (suhu ruang), hingga 7 hari (dalam kulkas)',
                'production' => 'UMKM Lokal Bojongsoang',
                'description' => 'Nikmati kelezatan Rendang Daging Sapi asli dengan resep turun-temurun.',
                'image' => '/images/rendang-kemasan.png',
                'category_id' => 4,
                'shoppee' => 'https://shopee.co.id/Paket-Salero-Dua-Rendang-Daging-Sapi-Santapan-Minang-i.750979323.22822973015?extraParams=%7B%22display_model_id%22%3A203819085977%2C%22model_selection_logic%22%3A3%7D&sp_atk=4a78ebf1-5a3d-4bc3-8906-1974eea1531e&xptdk=4a78ebf1-5a3d-4bc3-8906-1974eea1531e',
            ],
            [
                'name' => 'Cimol Bojot Frozen Premium',
                'slug' => 'cimol-bojot-frozen',
                'price' => 18000,
                'weight' => '250 gram',
                'type' => 'Cimol Bojot',
                'packaging' => 'Plastik Vacuum',
                'shelf_life' => '7 hari (suhu ruang), 1 bulan (freezer)',
                'production' => 'UMKM Bojongsoang',
                'description' => 'Cimol bojot khas Garut dengan tekstur kenyal dan bumbu bawang serta cabai yang melimpah.',
                'image' => '/images/cimol-bojot.png',
                'category_id' => 4,
            ],
            [
                'name' => 'Basreng Pedas Daun Jeruk',
                'slug' => 'basreng-kemasan',
                'price' => 12000,
                'weight' => '150 gram',
                'type' => 'Baso Goreng',
                'packaging' => 'Pouch Zipper',
                'shelf_life' => '3 bulan',
                'production' => 'Camilan Lokal Bojong',
                'description' => 'Baso goreng renyah dengan bumbu pedas spesial dan aroma daun jeruk yang segar.',
                'image' => '/images/basreng-kemasan.png',
                'category_id' => 4,
            ],
            [
                'name' => 'Kerupuk Kulit Sapi Asli',
                'slug' => 'kerupuk-kulit-sapi',
                'price' => 90000,
                'weight' => '1 kg',
                'type' => 'Kerupuk Kulit',
                'packaging' => 'Plastik Besar',
                'shelf_life' => '2 bulan',
                'production' => 'Produksi Lokal',
                'description' => 'Kerupuk kulit sapi kualitas super, renyah dan gurih. Tanpa bahan pengawet.',
                'image' => '/images/kerupuk-kulit.png',
                'category_id' => 4,
            ],
            [
                'name' => 'Daging Sapi Segar Pilihan',
                'slug' => 'daging-sapi',
                'price' => 120000,
                'weight' => '1 kg',
                'type' => 'Daging Sapi Segar',
                'packaging' => 'Wadah Steril',
                'shelf_life' => '1 hari (suhu ruang), 3-5 hari (kulkas)',
                'production' => 'Peternakan Lokal',
                'description' => 'Daging sapi segar kualitas terbaik dari peternakan lokal Bojongsoang.',
                'image' => '/images/daging-sapi.png',
                'category_id' => 4,
            ],
            [
                'name' => 'Ayam Potong Segar Bojongsoang',
                'slug' => 'ayam-potong',
                'price' => 35000,
                'weight' => '1 kg',
                'type' => 'Ayam Potong',
                'packaging' => 'Plastik Higienis',
                'shelf_life' => '1 hari (suhu ruang), 3 hari (kulkas)',
                'production' => 'Peternakan Ayam Lokal',
                'description' => 'Ayam potong segar yang diproses secara halal dan higienis.',
                'image' => '/images/ayam-potong.png',
                'category_id' => 4,
            ],
            [
                'name' => 'Ikan Laut Pilihan Segar',
                'slug' => 'ikan-laut-pilihan',
                'price' => 40000,
                'weight' => '1 kg',
                'type' => 'Ikan Laut',
                'packaging' => 'Es Batu & Plastik',
                'shelf_life' => '1 hari (suhu ruang), 2 hari (kulkas)',
                'production' => 'Nelayan Lokal',
                'description' => 'Ikan laut pilihan langsung dari nelayan. Kaya protein dan omega-3.',
                'image' => '/images/ikan-laut.png',
                'category_id' => 4,
            ],
            [
                'name' => 'Ikan Campur Segar Pilihan',
                'slug' => 'ikan-campur-segar',
                'price' => 30000,
                'weight' => '1 kg',
                'type' => 'Ikan Air Tawar',
                'packaging' => 'Plastik & Es',
                'shelf_life' => '1 hari',
                'production' => 'Budidaya Lokal Bojong',
                'description' => 'Berbagai jenis ikan air tawar segar hasil budidaya lokal Bojongsoang.',
                'image' => '/images/ikan-campur.png',
                'category_id' => 4,
            ],
            [
                'name' => 'Es Cendol Durian Bojong',
                'slug' => 'es-cendol-durian-bojong',
                'price' => 15000,
                'weight' => '400 ml',
                'type' => 'Minuman Dingin',
                'packaging' => 'Cup Plastik',
                'shelf_life' => '1 hari',
                'production' => 'Cendol Mantap Bojongsoang',
                'description' => 'Cendol kenyal dengan santan gurih, gula merah asli, dan topping durian segar yang melimpah.',
                'image' => '/images/cendol-durian.png',
                'category_id' => 5,
                'shoppee' => 'https://shopee.co.id/search?keyword=es-cendol-durian',
                'whatsapp' => '081298765432',
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}