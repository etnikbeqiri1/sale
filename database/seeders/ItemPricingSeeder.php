<?php

namespace Database\Seeders;

use App\Models\ItemPricing;
use Illuminate\Database\Seeder;

class ItemPricingSeeder extends Seeder
{
    public function run()
    {
        ItemPricing::create([
            'name' => 'PS4 - Pricing',
            'enabled' => 1,
        ]);

        ItemPricing::create([
            'name' => 'PS5 - Pricing',
            'enabled' => 1,
        ]);

        // Add more seed data as needed
    }
}
