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
        $products = ([
                [
                    'name' => 'Purse',
                    'image' => 'purse.png',
                    'price' => 10000,
                    'description' => 'This phone has exquisite features',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Teddy Bear',
                    'image' => 'p3.png',
                    'price' => 10000,
                    'description' => 'bear number 1',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Bear Doll',
                    'image' => 'p5.png',
                    'price' => 15000,
                    'description' => 'bear number 2',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Bouquet red',
                    'image' => 'p4.png',
                    'price' => 20000,
                    'description' => 'bouquet of red roses',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Purple bouquet',
                    'image' => 'p6.png',
                    'price' => 17000,
                    'description' => 'bouquet of purple roses',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Watch',
                    'image' => 'p2.png',
                    'price' => 10000,
                    'description' => 'This watch has exquisite features',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Ring',
                    'image' => 'p1.png',
                    'price' => 10000,
                    'description' => 'real ring',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Fake ring',
                    'image' => 'p8.png',
                    'price' => 1000,
                    'description' => 'why you even looking at this',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Leather watch',
                    'image' => 'p7.png',
                    'price' => 10000,
                    'description' => 'This better watch has exquisite features',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Gift card',
                    'image' => 'gifts.png',
                    'price' => 5000,
                    'description' => 'you think this would work?',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'cups',
                    'image' => 'agency-img.jpg',
                    'price' => 20000,
                    'description' => 'Basically ran out of pics',
                    'shop_id' => 1,
                    'stock' => 5,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
        ]);

        Product::insert($products);
    }
}
