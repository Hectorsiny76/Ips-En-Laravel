<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Nombreareas = ['SS7', 'BI', 'SSP7', 'PS', 'PSP7'];

        $Descripcionarea = ['Soporte en Sitio 7eleven', 'Oracle BI', 'Soporte en Sitio Petro7', 'Precios', 'Precios Petro 7'];

        for($i = 0; $i<count($Nombreareas); $i++){
            Area::create([
                'nombre'=> $Nombreareas[$i],
                'descripcion'=> $Descripcionarea[$i]
            ]);
        }
    }
}
