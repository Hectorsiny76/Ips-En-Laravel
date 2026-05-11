<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Establecimientotipo;
use App\Models\Archivo;
use App\Models\Archivotipo;

class ArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<5; $i++){
            $randArch = Archivotipo::inRandomOrder()->first();

            Archivo::create([
                'titulo'=>fake()->word(),
                'ruta'=>fake()->word().'/'.fake()->word().'/'.fake()->word(),
                'archivotipo_id'=>$randArch->id,
            ]);
        }
    }
}
