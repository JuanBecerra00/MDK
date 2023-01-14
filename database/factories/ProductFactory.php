<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'providers_id' => fake()->numberBetween(1, 100),
            'bills_id' => fake()->numberBetween(1, 100),
            'name' => fake()->word(),
            'ammount' => fake()->numberBetween(1, 100),
            'price' => fake()->numberBetween(10000, 100000),
            'type' => fake()->randomElement(['I' ,'C']),
            'status' => fake()->randomElement(['0' ,'1']),
        ];
    }
}
