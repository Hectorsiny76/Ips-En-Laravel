<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tiendaformato;

class TiendaformatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formatos = ['Hab A', 'Hab B', 'Hab AB', 'Hab C', 'Carretera', 'Trafico', 'Peatonal'];

        foreach($formatos as $formato){
            Tiendaformato::create([
                'nombre' => $formato,
            ]);
        }
    }
}
