<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Establecimientotipo;
use App\Models\Archivotipo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Archivo>
 */
class ArchivoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo'=>fake()->word(),
            'ruta'=>fake()->word().'/'.fake()->word().'/'.fake()->word(),
            'establecimientotipo_id'=>Establecimientotipo::factory(),
            'archivotipo_id'=>Archivotipo::factory(),
        ];
    }
}
