<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Servicio;
use App\Models\Microservicio;
use App\Models\Clasificacione;

class ClasificacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i<20; $i++){

            $randCat = Categoria::inRandomOrder()->first();

            $randSubcat = Subcategoria::inRandomOrder()->first();

            $randServ = Servicio::inRandomOrder()->first();

            $randMicro = Microservicio::inRandomOrder()->first();

            Clasificacione::create([
                'categoria_id' => $randCat->id,
                'subcategoria_id' => $randSubcat->id,
                'servicio_id' => $randServ->id,
                'microservicio_id' => $randMicro->id,
            ]);
        }
    }
}
