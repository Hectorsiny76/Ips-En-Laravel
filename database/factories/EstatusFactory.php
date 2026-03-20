<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estatus>
 */
class EstatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estatuses = ['Sin Servicio', 'En Servicio'];

        return [
            'nombre'=>fake()->randomElement($estatuses),
        ];
    }
}
