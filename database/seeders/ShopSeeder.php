<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'seller_id' => '2',
            'shop_name' => 'Pro Shop',
            'created_at' => now(),
            'updated_at'=> now(),
        ]);
    }
}
