<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $name = fake()->text();
        $path = Str::slug($name);

        return [
            'name' => $name,
            'image_id' => fake()->numberBetween(1, 1000),
            'path' => $path,
            'description' => fake()->text(1000),
        ];
    }
}
