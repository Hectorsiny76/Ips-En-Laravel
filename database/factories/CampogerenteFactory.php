<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Campo;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campogerente>
 */
class CampogerenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->name(),
            'tel'=>fake()->phoneNumber(),
            'correo'=>fake()->email(),
            'campo_id'=>Campo::factory(),
        ];
    }
}
