<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam, dan sayuran segar',
                'price' => 18000,
                'category' => 'Hidangan Utama',
                'image_url' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=400&q=80',
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
                'image_url' => 'https://images.unsplash.com/photo-1569050467447-ce54b3bbc37d?w=400&q=80',
                'available' => true,
                'is_recommended' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Soto Ayam',
                'description' => 'Soto kuning dengan ayam suwir dan pelengkap',
                'price' => 14000,
                'category' => 'Hidangan Utama',
                'image_url' => 'https://images.unsplash.com/photo-1547592180-85f173990554?w=400&q=80',
                'available' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Gado-Gado',
                'description' => 'Sayuran segar dengan bumbu kacang khas',
                'price' => 12000,
                'category' => 'Hidangan Utama',
                'image_url' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&q=80',
                'available' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Kue Nastar',
                'description' => 'Kue kering isi selai nanas, renyah dan lezat',
                'price' => 8000,
                'category' => 'Kue Kering',
                'image_url' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=400&q=80',
                'available' => true,
                'is_favorite' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Kue Putri Salju',
                'description' => 'Kue kering bertabur gula halus yang lembut',
                'price' => 7000,
                'category' => 'Kue Kering',
                'image_url' => 'https://images.unsplash.com/photo-1607920592519-bab2a80efd43?w=400&q=80',
                'available' => true,
                'is_favorite' => true,
            ],
            [
                'name' => 'Kue Lapis',
                'description' => 'Kue basah berlapis warna-warni yang kenyal',
                'price' => 5000,
                'category' => 'Kue Basah',
                'image_url' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&q=80',
                'available' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Klepon',
                'description' => 'Bola ketan isi gula merah berbalut kelapa parut',
                'price' => 5000,
                'category' => 'Kue Basah',
                'image_url' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=400&q=80',
                'available' => true,
                'is_favorite' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Pisang Goreng',
                'description' => 'Pisang kepok goreng crispy dengan tepung renyah',
                'price' => 6000,
                'category' => 'Gorengan',
                'image_url' => 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=400&q=80',
                'available' => true,
                'is_best_seller' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Tahu Isi',
                'description' => 'Tahu goreng isi sayuran dengan saus kacang',
                'price' => 4000,
                'category' => 'Gorengan',
                'image_url' => 'https://images.unsplash.com/photo-1606491956689-2ea866880c84?w=400&q=80',
                'available' => true,
            ],
            [
                'name' => 'Tempe Mendoan',
                'description' => 'Tempe tipis goreng tepung bumbu khas Banyumas',
                'price' => 4000,
                'category' => 'Gorengan',
                'image_url' => 'https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=400&q=80',
                'available' => false,
            ],
            [
                'name' => 'Kerupuk Udang',
                'description' => 'Kerupuk udang renyah pilihan terbaik',
                'price' => 3000,
                'category' => 'Kerupuk',
                'image_url' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=400&q=80',
                'available' => true,
            ],
            [
                'name' => 'Kerupuk Bawang',
                'description' => 'Kerupuk bawang gurih dan renyah',
                'price' => 2500,
                'category' => 'Kerupuk',
                'image_url' => 'https://images.unsplash.com/photo-1574484284002-952d92456975?w=400&q=80',
                'available' => true,
            ],
            [
                'name' => 'Es Teh Manis',
                'description' => 'Teh manis segar dengan es batu pilihan',
                'price' => 5000,
                'category' => 'Minuman',
                'image_url' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&q=80',
                'available' => true,
                'is_best_seller' => true,
                'is_popular' => true,
            ],
            [
                'name' => 'Es Jeruk',
                'description' => 'Jeruk peras segar dengan es batu',
                'price' => 7000,
                'category' => 'Minuman',
                'image_url' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=400&q=80',
                'available' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Jus Alpukat',
                'description' => 'Jus alpukat creamy dengan susu kental manis',
                'price' => 12000,
                'category' => 'Minuman',
                'image_url' => 'https://images.unsplash.com/photo-1638176066666-ffb2f013c7dd?w=400&q=80',
                'available' => false,
            ],
        ];

        foreach ($items as $item) {
            MenuItem::create($item);
        }
    }
}
