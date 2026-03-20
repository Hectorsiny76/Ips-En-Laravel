<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estatus;
use App\Models\Establecimiento;
use App\Models\Avaloncontrato;

class AvaloncontratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++){
            $randNum = (string)rand(700000000, 800000000);

            $estatus = Estatus::inRandomOrder()->first();

            $est = Establecimiento::inRandomOrder()->first();

            Avaloncontrato::create([
                'numero'=>$randNum,
                'estatus_id'=>$estatus->id,
                'establecimiento_id'=>$est->id,
            ]);
        }
    }
}
