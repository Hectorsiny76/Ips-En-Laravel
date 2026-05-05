<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Foliotipo>
 */
class FoliotipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $folioTipos = ['Problema', 'General', 'Requerimiento'];
        return [
            'tipo'=>fake()->unique()->randomElement($folioTipos),
        ];
    }
}
