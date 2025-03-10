<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'name' => fake()->name,
            'birthdate' => fake()->date,
            'cpf' => fake()->numberBetween(10000000000, 99999999999),
            'rg'  => fake()->numberBetween(10000000000, 99999999999),
            'is_foreign' => false,
            'passport' => null,
        ];
    }
}
