<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tiendaformato>
 */
class TiendaformatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $formatos = ['Hab A', 'Hab B', 'Hab AB', 'Hab C', 'Carretera', 'Trafico', 'Peatonal'];
        return [
            'nombre'=>fake()->unique()->randomElement($formatos),
        ];
    }
}
