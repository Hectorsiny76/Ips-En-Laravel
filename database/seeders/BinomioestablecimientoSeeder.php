<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Establecimiento;
use App\Models\Binomioestablecimiento;

class BinomioestablecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<10; $i++){
            $randTienda = Establecimiento::inRandomOrder()->first();
            $randEstacion = Establecimiento::inRandomOrder()->first();

            Binomioestablecimiento::create([
                'estacion_id'=>$randEstacion->id,
                'tienda_id'=>$randTienda->id,
            ]);
        }
    }
}
