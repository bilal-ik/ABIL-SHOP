<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Computers & Accessories',
            'Mobile Phones',
            'Home & Kitchen',
            'Fashion',
            'Beauty & Personal Care',
            'Sports & Outdoors',
            'Toys & Games',
            'Books',
            'Grocery',
            'Automotive',
            'Health & Household',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }
    }
}