<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Drivethrutienda;
use App\Models\Establecimiento;
use App\Models\Cajatipo;

class CajatipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<2; $i++){
            Cajatipo::create([
                'nombre' => 'Caja '.fake()->word(),
            ]);
        }
    }
}
