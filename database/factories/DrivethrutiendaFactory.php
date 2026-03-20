<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Establecimiento;
use App\Models\Numerocaja;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drivethrutienda>
 */
class DrivethrutiendaFactory extends Factory
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
            'numerocaja_id'=>Numerocaja::factory(),
        ];
    }
}
