<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $name = fake()->text();
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'quantity' => fake()->numberBetween(1, 1000),
            'price' => fake()->randomFloat(2, 1, 2000),
            'description' => fake()->text(2000),
        ];
    }
}
