<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pilotoprograma;

class PilotoprogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programas = ['ADV v5.1', 'POS v509', 'OpenPOS 10.1', 'Backoffice v3.1', 'LocalBOS v2.1'];

        foreach($programas as $programa){
            Pilotoprograma::create([
                'titulo'=>$programa,
                'descripcion_corta'=>fake()->text(),
                'descripcion_larga'=>fake()->paragraph(),
            ]);
        }
    }
}
