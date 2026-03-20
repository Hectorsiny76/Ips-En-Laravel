<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estatus;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estatuses = ['Sin Servicio', 'En Servicio'];
        foreach($estatuses as $estatus){
            Estatus::create([
                'nombre'=>$estatus,
            ]);
        }
    }
}
