<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mercadoencargado;
use App\Models\Mercado;
use App\Models\Asociado;

class MercadoencargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i<10; $i++){
            $randMer = Mercado::inRandomOrder()->first();
            $randAso = Asociado::inRandomOrder()->first();

            Mercadoencargado::create([
                'mercado_id'=>$randMer->id,
                'asociado_id'=>$randAso->id,
            ]);
        }
    }
}
