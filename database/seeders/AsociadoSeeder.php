<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Asociado;

class AsociadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i<10; $i++){
            $areaRandom = Area::inRandomOrder()->first();

            Asociado::create([
                'nombre' => fake()->name(),
                'tel' => fake()->phoneNumber(),
                'email'=>fake()->email(),
                'area_id' => $areaRandom->id
            ]);
        }
    }
}
