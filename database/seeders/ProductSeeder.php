<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name' => 'Sample Product',
            'category_id' => 1,
            'stock' => 100,
            'price' => 10000,
            'description' => 'This is a sample product description.',
            'shop_id' => 1,
            'date_added' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'image' => '1718688025.jpeg',
        ]);
    }
}
