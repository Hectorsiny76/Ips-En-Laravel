<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Establecimiento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Binomioestablecimiento>
 */
class BinomioestablecimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tienda_id'=>Establecimiento::factory(),
            'estacion_id'=>Establecimiento::factory(),
        ];
    }
}
