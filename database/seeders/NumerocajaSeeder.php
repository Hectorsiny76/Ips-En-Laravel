<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Numerocaja;

class NumerocajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i<=20; $i++){
            Numerocaja::create([
                'caja'=>$i
            ]);
        }
    }
}
