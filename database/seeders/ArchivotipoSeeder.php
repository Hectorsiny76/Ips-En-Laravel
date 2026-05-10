<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Archivotipo;

class ArchivotipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = ['Link', 'Doc'];

        foreach($tipos as $tipo){
            Archivotipo::create([
                'nombre'=>$tipo,
                'es_link'=>fake()->randomElement([true,false]),
                'mimes_permitidos'=>fake()->randomElement(['pdf','docx', 'xls', 'xlsx']),
                'tam_max_kb'=>fake()->numberBetween(1,6000),
            ]);
        }
    }
}
