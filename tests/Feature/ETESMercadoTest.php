<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Mercado;
use App\Models\Mercadogerente;
use App\Models\Estado;
use App\Models\Establecimientotipo;
use Illuminate\Database\QueryException;

uses(RefreshDatabase::class);

test('Un mercado puede existir sin sus llaves foraneas', function(){
    Mercado::create([
        'numero'=>'01',
    ]);

    $this->assertDatabaseHas('mercados', ['numero'=>'01']);
});

test('Un mercado puede existir con todas sus llaves foraneas', function(){
    $estTipo = Establecimientotipo::create([
        'nombre'=>'Tienda',
    ]);

    $merGerente = Mercadogerente::create([
        'nombre'=>'Checho Perez',
    ]);

    Mercado::create([
        'numero'=>'01',
        'establecimientotipo_id'=>$estTipo->id,
        'mercadogerente_id'=>$merGerente->id,
    ]);

    $this->assertDatabaseHas('mercados',['numero'=>'01', 'establecimientotipo_id'=>$estTipo->id, 'mercadogerente_id'=>$merGerente->id]);
});

test('un mercado puede ver su tipo de establecimiento', function(){
    $estTipo = Establecimientotipo::create([
        'nombre'=>'MasBodega'
    ]);

    $mercado = Mercado::create([
        'numero'=>'01',
        'establecimientotipo_id'=>$estTipo->id,
    ]);

    $establecimiento=$mercado->establecimientotipo;

    $this->assertEquals(1, $establecimiento->count());
});

test('un mercado puede ver su tipo de gerente de mercado', function(){
    $mercadoGer = Mercadogerente::create([
        'nombre'=>'Mendez Perez'
    ]);

    $mercado = Mercado::create([
        'numero'=>'01',
        'mercadogerente_id'=>$mercadoGer->id,
    ]);

    $unMerGer=$mercado->mercadogerente;

    $this->assertEquals(1, $unMerGer->count());
});

test('Dos mercados no pueden tener numeros iguales', function(){
    Mercado::create([
        'numero'=>'01',
    ]);

    Mercado::create([
        'numero'=>'01',
    ]);
})->throws(QueryException::class);