<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Despliegue>
 */
class DespliegueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo'=>fake()->word().' Proyect',
            'descripcion'=>fake()->sentence(),
            'area_id'=>Area::factory(),
            'inicio'=>fake()->dateTimeBetween('-1 week', 'now'),
            'fin'=>fake()->dateTimeBetween('-1 month', '-1 week'),
        ];
    }
}
