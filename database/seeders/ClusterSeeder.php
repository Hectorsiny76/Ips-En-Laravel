<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cluster;
use Illuminate\Database\Seeder;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clusters = ['Express', 'Familiar', 'Esquematico', 'Comercial', 'Completo'];

        foreach ($clusters as $cluster) {
            Cluster::create([
               'nombre'=>$cluster,
            ]);
        }
    }
}
