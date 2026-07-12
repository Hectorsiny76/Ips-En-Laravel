<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Establecimientotipo;
use App\Models\Mercado;

uses(RefreshDatabase::class);

test('Un tipo de establecimiento existe en la base de datos', function(){
    Establecimientotipo::create([
        'nombre'=>'Mercadia',
    ]);

    $this->assertDatabaseHas('establecimientotipos', ['nombre'=>'Mercadia']);
});

test('Un establecimientotipo puede existir en un mercado si el gerente y el estado están eliminados', function(){
    $estTipo = Establecimientotipo::create([
        'nombre'=>'MasBodega',
    ]);

    Mercado::create([
        'numero'=>'1',
        'establecimientotipo_id'=>$estTipo->id,
    ]);

    $this->assertDatabaseHas('mercados', ['establecimientotipo_id'=>$estTipo->id]);
});

test('Un tipo de establecimiento puede ver sus mercados', function(){
    $estTipo = Establecimientotipo::create([
        'nombre'=>'MercaDia',
    ]);

    Mercado::create([
        'numero'=>'01',
        'establecimientotipo_id'=>$estTipo->id,
    ]);

    Mercado::create([
        'numero'=>'02',
        'establecimientotipo_id'=>$estTipo->id,
    ]);

    $mercados = $estTipo->mercados;

    $this->assertEquals(2, $mercados->count());
});