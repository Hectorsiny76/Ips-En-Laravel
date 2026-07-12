<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Establecimiento;
use App\Models\Tiendaformato;
use App\Models\Tidelprograma;
use App\Models\Campogerente;

uses(RefreshDatabase::class);

test('Un establecimiento puede existir en la base de datos', function(){
    Establecimiento::factory()->create();

    $this->assertDatabaseCount('establecimientos', 1); 
});

test('Un establecimiento puede no tener gerente', function(){
   Establecimiento::factory()->create(['campogerente_id'=>null]); 

   $this->assertDatabaseHas('establecimientos', ['campogerente_id'=>null]);
});

test('Un establecimiento puede ver su gerente', function(){
    $est = Establecimiento::factory()->create();

    $gerente = $est->campogerente;

    $this->assertEquals(1, $gerente->count());
});

test('Un gerente de campo puede ver sus establecimientos', function(){
    $gerente = Campogerente::factory()->create();

    $formatotienda = Tiendaformato::factory()->create();

    Establecimiento::factory()->count(10)->create(['campogerente_id'=>$gerente->id, 'tiendaformato_id'=>$formatotienda->id]);

    $establecimientos = $gerente->establecimientos;

    $this->assertEquals(10, $establecimientos->count());
});

test('Pueden haber dos establecimientos con el mismo número', function(){
    Establecimiento::factory()->create(['numero'=>'01']);

    Establecimiento::factory()->create(['numero'=>'01']);

    $this->assertDatabaseCount('establecimientos', 2);
});