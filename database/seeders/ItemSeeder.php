<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        Item::create([
            'name' => 'Sony 4 - 01',
            'state' => 0,
            'enabled' => 1,
            'item_pricing_id' => 1,
        ]);

        Item::create([
            'name' => 'Sony 5 - 02',
            'state' => 1,
            'enabled' => 1,
            'item_pricing_id' => 2,
        ]);

        // Add more seed data as needed
    }
}
