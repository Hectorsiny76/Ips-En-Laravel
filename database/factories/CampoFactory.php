<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mercado;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campo>
 */
class CampoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero'=>(string)fake()->unique()->numberBetween(1,999999),
            'mercado_id'=>Mercado::factory(),
        ];
    }
}
