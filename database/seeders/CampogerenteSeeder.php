<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campogerente;
use App\Models\Campo;

class CampogerenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $camposId = Campo::pluck('id')->shuffle();

        for($i=0; $i<10; $i++){

            $camposAsignado = $camposId->pop();

            Campogerente::create([
                'nombre'=>fake()->name(),
                'tel'=>fake()->phoneNumber(),
                'correo'=>fake()->email(),
                'campo_id'=>$camposAsignado,
            ]);
        }
    }
}
