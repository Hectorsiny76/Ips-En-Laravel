<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tidelprograma;

class TidelprogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<10; $i++){
            Tidelprograma::create([
                'ip' => fake()->numberBetween(10,255).'.'.fake()->numberBetween(50,255).'.'.fake()->numberBetween(15, 255).'.'.fake()->numberBetween(1,255),
                'fechamigracion' => fake()->date()
            ]);
        }
    }
}
