<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Microservicio;

class MicroservicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i<20; $i++){
            Microservicio::create([
                'nombre'=>fake()->word() . 'Micro'
            ]);
        }
    }
}
