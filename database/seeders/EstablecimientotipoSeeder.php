<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Establecimientotipo;

class EstablecimientotipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = ['Tienda', 'Estacion'];

        foreach($tipos as $tipo){
            Establecimientotipo::create([
                'nombre'=>$tipo
            ]);
        }
    }
}
