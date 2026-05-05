<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Establecimiento;
use App\Models\Estatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avaloncontrato>
 */
class AvaloncontratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randNum = (string)rand(700000000, 800000000);
        return [
            'numero'=>$randNum,
            'estatus_id'=>Estatus::factory(),
            'establecimiento_id'=>Establecimiento::factory(),
        ];
    }
}
