<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mercadogerente;
use App\Models\Estado;

class MercadogerenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i<10; $i++){

            $randEstado = Estado::inRandomOrder()->first();

            Mercadogerente::create([
                'nombre'=>fake()->name(),
                'estado_id'=>$randEstado->id,
            ]);
        }
    }
}
