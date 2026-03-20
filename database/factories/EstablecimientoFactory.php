<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tidelprograma;
use App\Models\Tiendaformato;
use App\Models\Campogerente;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Establecimiento>
 */
class EstablecimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomCDC = (string)rand(6000, 8000);

        return [
            'numero'=>(string)fake()->numberBetween(1,999999),
            'nombre'=>fake()->word(),
            'cajas_tpvs'=>fake()->numberBetween(1,20),
            'idred'=>fake()->numberBetween(10,255).'.'.fake()->numberBetween(50,255).'.'.fake()->numberBetween(15, 255),
            'campogerente_id'=>Campogerente::factory(),
            'tidelprograma_id'=>Tidelprograma::factory(),
            'tiendaformato_id'=>Tiendaformato::factory(),
            'centrodecostos'=>fake()->randomElement([null, $randomCDC]),
            'tel'=>fake()->phoneNumber(),
            'correo'=>fake()->email(),
        ];
    }
}
