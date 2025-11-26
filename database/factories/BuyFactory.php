<?php

namespace Database\Factories;

use App\Models\Buy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buy>
 */
class BuyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->randomElement(Buy::$brand),
            'model' => fake()->word,
            'colour' => fake()->colorName(),
            'type' => fake()->randomElement(Buy::$type),
            'category' => fake()->randomElement(Buy::$category),
            'year' => fake()->numberBetween(2019, 2025),
            'price' => fake()->numberBetween(5_000, 200_000),

        ];
    }
}
