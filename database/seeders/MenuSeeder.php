<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->insert([
            [
                'name' => 'Mongolian Beef',
                'category' => 'Main Course',
                'description' => 'A sweet and savory stir-fry with tender beef and a rich soy-based sauce.',
                'price' => 175000,
                'image_path' => 'https://placehold.co/150x150/333333/eab308?text=Beef',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spicy Kung Pao',
                'category' => 'Main Course',
                'description' => 'A classic Sichuan dish with spicy chicken, peanuts, and vegetables.',
                'price' => 150000,
                'image_path' => 'https://placehold.co/150x150/333333/eab308?text=Chicken',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Classic Iced Tea',
                'category' => 'Drink',
                'description' => 'Refreshing black tea brewed to perfection, served over ice.',
                'price' => 50000,
                'image_path' => 'https://placehold.co/150x150/333333/eab308?text=Tea',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
