<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Foliotipo;
use App\Models\Folio;

class FolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++){
            $tipoId = Foliotipo::inRandomOrder()->first();

            Folio::create([
                'numero'=>fake()->word().' Folio',
                'foliotipo_id'=>$tipoId->id,
                'titulo'=>'Un problema con '.fake()->word(),
                'descripcion'=>fake()->sentence(),
            ]);
        }
    }
}
