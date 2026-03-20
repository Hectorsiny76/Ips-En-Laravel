<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Establecimientotipo>
 */
class EstablecimientotipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipos = ['Tienda', 'Estacion'];
        return [
            'nombre'=>fake()->randomElement($tipos),
        ];
    }
}
