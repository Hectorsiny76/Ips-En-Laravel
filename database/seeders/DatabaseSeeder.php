<?php

namespace Database\Seeders;

use App\Models\Cajatipo;
use App\Models\Campogerente;
use App\Models\Categoria;
use App\Models\Pilotoprograma;
use App\Models\Tidelprograma;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
           'name'=>'Hector',
           'email'=>'hecmasanchez1976@gmail.com',
            'password'=> Hash::make('Imthenumber176@'),
        ]);

        $this->call([
            AreaSeeder::class,
            AsociadoSeeder::class,

            CategoriaSeeder::class,
            SubcategoriaSeeder::class,
            ServicioSeeder::class,
            MicroservicioSeeder::class,
            ClasificacioneSeeder::class,
            EstadoSeeder::class,
            MercadogerenteSeeder::class,
            EstablecimientotipoSeeder::class,
            MercadoSeeder::class,
            CampoSeeder::class,
            CampogerenteSeeder::class,
            TidelprogramaSeeder::class,
            TiendaformatoSeeder::class,
            ClusterSeeder::class,
            EstablecimientoSeeder::class,
            CajatipoSeeder::class,
            PilotoprogramaSeeder::class,
            PilotoestablecimientoSeeder::class,
            BinomioestablecimientoSeeder::class,
            MercadoencargadoSeeder::class,
            DespliegueSeeder::class,
            FoliotipoSeeder::class,
            FolioSeeder::class,
            ArchivotipoSeeder::class,
            ArchivoSeeder::class,
            EstatusSeeder::class,
            AvaloncontratoSeeder::class,
        ]);
    }
}
