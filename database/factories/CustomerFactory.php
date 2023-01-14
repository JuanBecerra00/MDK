<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => fake()->randomElement(['CC' ,'TI', 'CE', 'P']),
            'cc' => fake()->numberBetween(10000000, 10000000000),
            'name' => fake()->name(),
            'department_id' => fake()->numberBetween(17, 20),
            'city_id' => fake()->numberBetween(1, 1123),
            'email' => fake()->email(),
            'phone' => fake()->numberBetween(3000000000, 3219999999),
        ];
    }
}
