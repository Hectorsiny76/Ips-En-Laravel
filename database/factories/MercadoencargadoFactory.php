<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mercado;
use App\Models\Asociado;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mercadoencargado>
 */
class MercadoencargadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mercado_id'=>Mercado::factory(),
            'asociado_id'=>Asociado::factory(),
        ];
    }
}
