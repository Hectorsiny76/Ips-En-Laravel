<?php

namespace Database\Seeders;

use App\Models\Cluster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Establecimiento;
use App\Models\Campogerente;
use App\Models\Tiendaformato;
use App\Models\Tidelprograma;

class EstablecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<20; $i++){
            $randGerente = Campogerente::inRandomOrder()->first();

            $randTidelip = Tidelprograma::inRandomOrder()->first();

            $randFormato = Tiendaformato::inRandomOrder()->first();

            $randCluster = Cluster::inRandomOrder()->first();

            $randCDC = rand(6000, 9000);

            Establecimiento::create([
                'numero'=>$i,
                'nombre'=>fake()->word(),
                'cajas_tpvs'=>fake()->numberBetween(3,20),
                'idred'=>fake()->numberBetween(10,255).'.'.fake()->numberBetween(50,255).'.'.fake()->numberBetween(15, 255),
                'campogerente_id'=>$randGerente->id,
                'tidelprograma_id'=>fake()->randomElement([null, $randTidelip->id]),
                'tiendaformato_id'=>fake()->randomElement([null, $randFormato->id]),
                'centrodecostos'=>fake()->randomElement([null, $randCDC]),
                'cluster_id'=>fake()->randomElement([null, $randCluster->id]),
                'tel'=>fake()->phoneNumber(),
                'correo'=>fake()->email(),
            ]);
        }
    }
}
