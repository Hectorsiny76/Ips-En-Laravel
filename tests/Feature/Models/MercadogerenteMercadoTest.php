<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Mercado;
use App\Models\Mercadogerente;
use Illuminate\Database\QueryException;

uses(RefreshDatabase::class);

test('Un mercadogerente puede existir en la base de datos', function(){
    Mercadogerente::create([
        'nombre'=>'Pablo Medina',
    ]);

    $this->assertDatabaseHas('mercadogerentes', ['nombre'=>'Pablo Medina']);
});

test('Un mercado puede existir solo con el mercadogerente', function(){
    $merGerente = Mercadogerente::create([
        'nombre'=>'Pablo Medina',
    ]);

    Mercado::create([
        'numero'=>'01',
        'mercadogerente_id'=> $merGerente->id,
    ]);

    $this->assertDatabaseHas('mercados',['mercadogerente_id'=>$merGerente->id]);
});

test('Un gerente de mercado puede ver SOLO su mercado', function(){
    $gerMer = Mercadogerente::create([
        'nombre'=>'Gerardo Reyes',
    ]);

        Mercado::create([
        'numero'=>'01',
        'mercadogerente_id'=>$gerMer->id,
    ]);
    $mercados = $gerMer->mercado;

    $this->assertEquals(1, $mercados->count());
});

test('Un gerente de mercado NO puede tener más de UN mercado', function(){
    $gerMer = Mercadogerente::create([
        'nombre'=>'Gerardo Reyes',
    ]);

        Mercado::create([
        'numero'=>'01',
        'mercadogerente_id'=>$gerMer->id,
    ]);

    Mercado::create([
        'numero'=>'01',
        'mercadogerente_id'=>$gerMer->id,
    ]);
})->throws(QueryException::class);