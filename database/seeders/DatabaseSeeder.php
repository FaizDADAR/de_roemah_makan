<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin user untuk Filament
        User::factory()->create([
            'name' => 'masfaiz',
            'email' => '',
            'password' => bcrypt(''),
        ]);

        // Seed menu items
        $this->call([
            MenuItemSeeder::class,
        ]);
    }
}
