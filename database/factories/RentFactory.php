<?php

namespace Database\Factories;

use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->randomElement(Rent::$brand),
            'model' => fake()->word,
            'colour' => fake()->colorName(),
            'type' => fake()->randomElement(Rent::$type),
            'category' => fake()->randomElement(Rent::$category),
            'year' => fake()->numberBetween(2019, 2025),
            'rate' => fake()->numberBetween(50, 10_000)

        ];
    }
}
