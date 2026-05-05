<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tidelprograma>
 */
class TidelprogramaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip'=>fake()->numberBetween(10,255).'.'.fake()->numberBetween(50,255).'.'.fake()->numberBetween(15, 255).'.'.fake()->numberBetween(1,255),
            'fechamigracion'=>fake()->date(),
        ];
    }
}
