<?php

namespace Database\Factories;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $name = fake()->words(3, true);

    return [
        'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
        'name' => ucfirst($name),
        'slug' => \Illuminate\Support\Str::slug($name) . '-' . uniqid(),
        'description' => fake()->paragraph(),
        'price' => fake()->randomFloat(2, 5, 500),
        'stock' => fake()->numberBetween(0, 100),
        'image' => null,
        'is_active' => true,
    ];
}
}
