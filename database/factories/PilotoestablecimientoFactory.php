<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Establecimiento;
use App\Models\Pilotoprograma;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pilotoestablecimiento>
 */
class PilotoestablecimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'establecimiento_id'=>Establecimiento::factory(),
            'pilotoprograma_id'=>Pilotoprograma::factory(),
        ];
    }
}
