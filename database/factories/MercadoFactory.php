<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Estado;
use App\Models\Mercadogerente;
use App\Models\Establecimientotipo;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mercado>
 */
class MercadoFactory extends Factory
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
            'mercadogerente_id'=>Mercadogerente::factory(),
            'establecimientotipo_id'=>Establecimientotipo::factory(),
        ];
    }
}
