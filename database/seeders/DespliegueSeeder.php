<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Despliegue;

class DespliegueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 3; $i++){
            $randArea = Area::inRandomOrder()->first();

            Despliegue::create([
            'titulo'=>fake()->word().' Proyect',
            'descripcion'=>fake()->sentence(),
            'area_id'=>$randArea->id,
            'inicio'=>fake()->dateTimeBetween('-1 month', '-1 week'),
            'fin'=>fake()->dateTimeBetween('-1 week', 'now'),
            ]);
        }
    }
}
