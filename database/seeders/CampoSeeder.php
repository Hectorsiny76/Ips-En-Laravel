<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Campo;
use App\Models\Mercado;

class CampoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i<10; $i++){

            $randMercado = Mercado::inRandomOrder()->first();

            Campo::create([
                'numero'=>$i,
                'mercado_id' => $randMercado->id,
            ]);
        }
    }
}
