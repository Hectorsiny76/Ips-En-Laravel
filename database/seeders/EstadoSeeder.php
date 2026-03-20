<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = ['Tamaulipas', 'Coahuila', 'Nuevo Leon', 'Yucatán', 'Quintana Roo', 'Jalisco', 'Baja California', 'México', 'Sonora', 'Puebla', 'Morelos'];

        foreach($estados as $estado){
            Estado::create([
                'nombre'=>$estado
            ]);
        }
    }
}
