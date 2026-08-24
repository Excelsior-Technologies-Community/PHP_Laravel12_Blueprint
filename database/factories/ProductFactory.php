<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(3, true),
            'price' => fake()->randomFloat(2, 10, 9999),
            'description' => fake()->sentence(10, true),
            'category_id' => Category::factory(),
            'status' => fake()->boolean(80),
            'image' => null,
            'deleted_at' => null,
        ];
    }
}
