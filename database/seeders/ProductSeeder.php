<?php
// filepath: /d:/RoyalCAPS/RoyalCaps/database/seeders/ProductSeeder.php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Sample Product 1',
            'description' => 'This is a sample product description.',
            'price' => 19.99,
            'stock' => 100,
            'category' => 'Men',
            'color' => 'Red',
            'product_image' => 'https://via.placeholder.com/150',
            'user_id' => 1, // Assuming user with ID 1 exists
        ]);

        Product::create([
            'name' => 'Sample Product 2',
            'description' => 'This is another sample product description.',
            'price' => 29.99,
            'stock' => 50,
            'category' => 'Women',
            'color' => 'Blue',
            'product_image' => 'https://via.placeholder.com/150',
            'user_id' => 1, // Assuming user with ID 1 exists
        ]);
    }
}