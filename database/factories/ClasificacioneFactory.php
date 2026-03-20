<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clasificacione;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Servicio;
use App\Models\Microservicio;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clasificacione>
 */
class ClasificacioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria_id'=>Categoria::factory(),
            'subcategoria_id'=>Subcategoria::factory(),
            'servicio_id'=>Servicio::factory(),
            'microservicio_id'=>Microservicio::factory(),
        ];
    }
}
