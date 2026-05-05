<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Area>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $Nombreareas = ['SS7', 'BI', 'SSP7', 'PS', 'PSP7'];

        $Descripcionarea = ['Soporte en Sitio 7eleven', 'Oracle BI', 'Soporte en Sitio Petro7', 'Precios', 'Precios Petro 7'];

        return [
            'nombre'=>fake()->randomElement($Nombreareas),
            'descripcion'=>fake()->randomElement($Descripcionarea),
        ];
    }
}
