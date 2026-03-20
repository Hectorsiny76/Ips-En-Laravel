<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Campogerente;
use App\Models\Campo;

uses(RefreshDatabase::class);

test('Un gerente de campo puede existir en la base de datos sin campo', function(){
    Campogerente::create([
        'nombre'=>'Henry Wong',
        'tel'=>'8181818181',
    ]);

    $this->assertDatabaseHas('campogerentes', ['nombre'=>'Henry Wong', 'tel'=>'8181818181']);
});

test('Un gerente de campo puede tener campo', function(){
    $campo = Campo::create([
        'numero'=>'01'
    ]);

    Campogerente::create([
        'nombre'=>'Henry Wong',
        'tel'=>'9191919191',
        'campo_id'=>$campo->id,
    ]);

    $this->assertDatabaseHas('campogerentes',['nombre'=>'Henry Wong']);
});

test('Un gerente de campo puede no tener telefono ni campo', function(){
    Campogerente::create([
        'nombre'=>'Henry Wong'
    ]);

    $this->assertDatabaseHas('campogerentes',['nombre'=>'Henry Wong']);
});

test('Un gerente de campo NO puede no tener nombre', function(){
    Campogerente::create([
        'tel'=>'0101010101'
    ]);
})->throws(QueryException::class);

test('Un gerente de campo puede ver su campo', function(){
    $campo = Campo::create([
        'numero'=>'01'
    ]);

    $campoger = Campogerente::create([
        'nombre'=>'Henry Wong',
        'tel'=>'9191919191',
        'campo_id'=>$campo->id,
    ]);

    $campo1 = $campoger->campo;

    $this->assertEquals(1, $campo1->count());
});

test('Un campo puede ver su gerente', function(){
    $campo = Campo::create([
        'numero'=>'01'
    ]);

    Campogerente::create([
        'nombre'=>'Henry Wong',
        'tel'=>'9191919191',
        'campo_id'=>$campo->id,
    ]);

    $ger = $campo->campogerente;

    $this->assertEquals(1, $ger->count());
});