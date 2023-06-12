<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Product 1',
            'internal_name' => 'Internal Name 1',
            'price' => 9.99,
            'image' => 'product1.jpg',
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Product 2',
            'internal_name' => 'Internal Name 2',
            'price' => 19.99,
            'image' => 'product2.jpg',
            'stock' => 5,
        ]);

        // Add more seed data as needed
    }
}
