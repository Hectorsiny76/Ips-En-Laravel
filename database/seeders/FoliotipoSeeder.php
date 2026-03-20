<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Foliotipo;

class FoliotipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folioTipos = ['Problema', 'General', 'Requerimiento'];
        foreach($folioTipos as $folioTipo){
            Foliotipo::create([
                'tipo'=>$folioTipo,
            ]);
        }
    }
}
