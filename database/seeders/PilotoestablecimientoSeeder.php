<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Establecimiento;
use App\Models\Pilotoestablecimiento;
use App\Models\Pilotoprograma;

class PilotoestablecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<15; $i++){
            $randEst = Establecimiento::inRandomOrder()->first();
            $randProg = Pilotoprograma::inRandomOrder()->first();

            Pilotoestablecimiento::create([
                'establecimiento_id'=>$randEst->id,
                'pilotoprograma_id'=>$randProg->id,
            ]);
        }
    }
}
