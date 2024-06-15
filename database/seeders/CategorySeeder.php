<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Kitchen',
            'Food',
            'Clothings',
            'Accessories',
            'Sports',
            'Gaming',
            'Gifts',
            'Books',
            'Entertainment'
        ];

        foreach ($categories as $category) {
            Category::create(['category_name' => $category]);
        }
    }
}