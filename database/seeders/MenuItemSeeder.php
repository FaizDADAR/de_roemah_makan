<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam, dan sayuran segar',
                'price' => 15000,
                'category' => 'Hidangan Utama',
                'image_url' => '',
                'available' => true,
                'is_best_seller' => true,
                'is_recommended' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Mie Ayam Bakso',
                'description' => 'Mie kenyal dengan ayam cincang dan bakso sapi',
                'price' => 15000,
                'category' => 'Hidangan Utama',
                'image_url' => '',
                'available' => true,
                'is_recommended' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Soto Ayam',
                'description' => 'Soto kuning dengan ayam suwir dan pelengkap',
                'price' => 12000,
                'category' => 'Hidangan Utama',
                'image_url' => '',
                'available' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Gado-Gado',
                'description' => 'Sayuran segar dengan bumbu kacang khas',
                'price' => 10000,
                'category' => 'Hidangan Utama',
                'image_url' => '',
                'available' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Kue Nastar',
                'description' => 'Kue kering isi selai nanas, renyah dan lezat',
                'price' => 20000,
                'category' => 'Kue Kering',
                'image_url' => '',
                'available' => true,
                'is_favorite' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Kue Putri Salju',
                'description' => 'Kue kering bertabur gula halus yang lembut',
                'price' => 18000,
                'category' => 'Kue Kering',
                'image_url' => '',
                'available' => true,
                'is_favorite' => true,
            ],
            [
                'name' => 'Kue Lapis',
                'description' => 'Kue basah berlapis warna-warni yang kenyal',
                'price' => 20000,
                'category' => 'Kue Basah',
                'image_url' => '',
                'available' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Klepon',
                'description' => 'Bola ketan isi gula merah berbalut kelapa parut',
                'price' => 5000,
                'category' => 'Kue Basah',
                'image_url' => '',
                'available' => true,
                'is_favorite' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Pisang Goreng',
                'description' => 'Pisang kepok goreng crispy dengan tepung renyah',
                'price' => 6000,
                'category' => 'Gorengan',
                'image_url' => '',
                'available' => true,
                'is_best_seller' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Tahu Isi',
                'description' => 'Tahu goreng isi sayuran dengan saus kacang',
                'price' => 4000,
                'category' => 'Gorengan',
                'image_url' => '',
                'available' => true,
            ],
            [
                'name' => 'Tempe Mendoan',
                'description' => 'Tempe tipis goreng tepung bumbu khas Banyumas',
                'price' => 4000,
                'category' => 'Gorengan',
                'image_url' => '',
                'available' => false,
            ],
            [
                'name' => 'Kerupuk Udang',
                'description' => 'Kerupuk udang renyah pilihan terbaik',
                'price' => 3000,
                'category' => 'Kerupuk',
                'image_url' => '',
                'available' => true,
            ],
            [
                'name' => 'Kerupuk Bawang',
                'description' => 'Kerupuk bawang gurih dan renyah',
                'price' => 2500,
                'category' => 'Kerupuk',
                'image_url' => '',
                'available' => true,
            ],
            [
                'name' => 'Es Teh Manis',
                'description' => 'Teh manis segar dengan es batu pilihan',
                'price' => 5000,
                'category' => 'Minuman',
                'image_url' => '',
                'available' => true,
                'is_best_seller' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Es Jeruk',
                'description' => 'Jeruk peras segar dengan es batu',
                'price' => 7000,
                'category' => 'Minuman',
                'image_url' => '',
                'available' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Jus Alpukat',
                'description' => 'Jus alpukat creamy dengan susu kental manis',
                'price' => 12000,
                'category' => 'Minuman',
                'image_url' => '',
                'available' => false,
            ],
        ];

        foreach ($items as $item) {
            if (empty($item['image_url'])) {
                $item['image_url'] = '/images/menu/' . Str::slug($item['name']) . '.jpg';
            }
            MenuItem::create($item);
        }
    }
}
