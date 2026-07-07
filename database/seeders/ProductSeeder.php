<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productsByCategory = [
            'Electronics' => ['Wireless Bluetooth Earbuds', '55" 4K Smart TV', 'Portable Bluetooth Speaker', 'Noise Cancelling Headphones', 'Smart Watch Series 8'],
            'Computers & Accessories' => ['Mechanical Gaming Keyboard', '27" Curved Monitor', 'Wireless Mouse', 'USB-C Hub Adapter', 'External SSD 1TB'],
            'Mobile Phones' => ['Samsung Galaxy S24', 'iPhone 15 Pro', 'Google Pixel 8', 'Phone Case Clear', 'Fast Charger 65W'],
            'Home & Kitchen' => ['Air Fryer 5.8QT', 'Stainless Steel Cookware Set', 'Robot Vacuum Cleaner', 'Electric Kettle', 'Coffee Maker'],
            'Fashion' => ['Men\'s Slim Fit Jeans', 'Women\'s Summer Dress', 'Running Shoes', 'Leather Wallet', 'Sunglasses UV Protection'],
            'Beauty & Personal Care' => ['Vitamin C Serum', 'Electric Toothbrush', 'Hair Dryer Ionic', 'Facial Cleanser', 'Body Lotion'],
            'Sports & Outdoors' => ['Yoga Mat Non-Slip', 'Adjustable Dumbbells', 'Camping Tent 4-Person', 'Resistance Bands Set', 'Water Bottle Insulated'],
            'Toys & Games' => ['LEGO Classic Set', 'Remote Control Car', 'Puzzle 1000 Pieces', 'Board Game Family', 'Action Figure Set'],
            'Books' => ['Atomic Habits', 'The Psychology of Money', 'Rich Dad Poor Dad', 'Sapiens', 'Deep Work'],
            'Grocery' => ['Organic Olive Oil', 'Mixed Nuts 1kg', 'Green Tea Bags', 'Honey Raw 500g', 'Protein Powder'],
            'Automotive' => ['Car Phone Mount', 'Tire Pressure Gauge', 'Car Vacuum Cleaner', 'Dash Cam HD', 'Jump Starter Kit'],
            'Health & Household' => ['Digital Thermometer', 'Blood Pressure Monitor', 'First Aid Kit', 'Hand Sanitizer 500ml', 'Face Masks Pack'],
        ];

        foreach ($productsByCategory as $categoryName => $products) {
            $category = Category::where('name', $categoryName)->first();

            if (!$category) continue;

            foreach ($products as $productName) {
                Product::firstOrCreate(
                    ['slug' => Str::slug($productName)],
                    [
                        'category_id' => $category->id,
                        'name' => $productName,
                        'description' => fake()->sentence(15),
                        'price' => fake()->randomFloat(2, 9.99, 999.99),
                        'stock' => fake()->numberBetween(0, 100),
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}