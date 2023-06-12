<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    public function run()
    {
        Price::create([
            'name' => 'Sony 4 - 2 Players',
            'price' => 1.5,
            'start_price' => 0.3,
            'item_pricing_id' => 1
        ]);

        Price::create([
            'name' => 'Sony 4 - 4 Players',
            'price' => 2.3,
            'start_price' => 0.5,
            'item_pricing_id' => 1
        ]);

        Price::create([
            'name' => 'Sony 5 - 2 Players',
            'price' => 1.8,
            'start_price' => 0.3,
            'item_pricing_id' => 2
        ]);

        Price::create([
            'name' => 'Sony 5 - 4 Players',
            'price' => 2.8,
            'start_price' => 0.5,
            'item_pricing_id' => 2
        ]);

        // Add more seed data as needed
    }
}
