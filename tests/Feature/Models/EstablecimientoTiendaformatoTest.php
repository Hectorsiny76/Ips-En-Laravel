<?php

use App\Models\Establecimiento;
use App\Models\Tiendaformato;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;

uses(RefreshDatabase::class);

test('Un establecimiento puede ver su formato de tienda', function(){
    $formatotienda = Tiendaformato::factory()->create();

    $est = Establecimiento::factory()->create(['tiendaformato_id'=>$formatotienda->id]);

    $formato = $est->tiendaformato;

    $this->assertEquals(1, $formato->count());
});

test('Un formato de tienda puede ver sus establecimientos', function(){
    $formatotienda = Tiendaformato::factory()->create();

    Establecimiento::factory()->count(50)->create(['tiendaformato_id'=>$formatotienda->id]);

    $tiendasconformato = $formatotienda->tiendasformato;

    $this->assertEquals(50, $tiendasconformato->count());
});