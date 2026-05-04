<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Establecimiento;
use App\Models\Cajatipo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Autocobrotienda>
 */
class AutocobrotiendaFactory extends Factory
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
            'numerocaja_id'=>Cajatipo::factory(),
        ];
    }
}
