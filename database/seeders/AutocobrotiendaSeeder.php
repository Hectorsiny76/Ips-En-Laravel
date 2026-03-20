<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Establecimiento;
use App\Models\Numerocaja;
use App\Models\Autocobrotienda;

class AutocobrotiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<15; $i++){
            $randCaja = Numerocaja::inRandomOrder()->first();
            $randEst = Establecimiento::inRandomOrder()->first();

            Autocobrotienda::create([
                'establecimiento_id'=>$randEst->id,
                'numerocaja_id'=>$randCaja->id,
            ]);

        }
    }
}
