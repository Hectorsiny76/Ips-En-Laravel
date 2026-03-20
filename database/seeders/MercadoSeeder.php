<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mercado;
use App\Models\Mercadogerente;
use App\Models\Establecimientotipo;
use App\Models\Estado;

class MercadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mercadogerentesId = Mercadogerente::pluck('id')->shuffle();

        for($i = 0; $i<10; $i++){

            $randEstablecimientotipo = Establecimientotipo::inRandomOrder()->first();

            $mercadogerenteAsignado = $mercadogerentesId->pop();

            Mercado::create([
                'numero'=>$i,
                'mercadogerente_id'=>$mercadogerenteAsignado,
                'establecimientotipo_id'=>$randEstablecimientotipo->id
            ]);

        }
    }
}
