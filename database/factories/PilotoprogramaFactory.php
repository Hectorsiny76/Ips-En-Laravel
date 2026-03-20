<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pilotoprograma>
 */
class PilotoprogramaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $programas = ['ADV v5.1', 'POS v509', 'OpenPOS 10.1', 'Backoffice v3.1', 'LocalBOS v2.1'];

        return [
            'titulo'=>fake()->randomElement($programas),
        ];
    }
}
