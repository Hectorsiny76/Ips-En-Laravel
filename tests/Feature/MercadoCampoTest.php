<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Mercado;
use App\Models\Campo;

uses(RefreshDatabase::class);

test('Un campo puede existir sin su mercado', function(){
    Campo::create([
        'numero'=>'01'
    ]);

    $this->assertDatabaseHas('campos', ['numero'=>'01']);
});

test('Un campo puede existir con su mercado', function(){
    $mer = Mercado::create([
        'numero'=>'501',
    ]);

    Campo::create([
        'numero'=>'01',
        'mercado_id'=>$mer->id,
    ]);

    $this->assertDatabaseHas('campos', ['mercado_id'=>$mer->id]);
});

test('Un campo puede ver su mercado', function(){
    $mer = Mercado::create([
        'numero'=>'501',
    ]);

    $campo = Campo::create([
        'numero'=>'01',
        'mercado_id'=>$mer->id,
    ]);

    $mercado = $campo->mercado;

    $this->assertEquals(1, $mercado->count());
});

test('Un mercado puede ver sus campos', function(){
    $mer = Mercado::create([
        'numero'=>'501',
    ]);

    Campo::create([
        'numero'=>'01',
        'mercado_id'=>$mer->id,
    ]);

    Campo::create([
        'numero'=>'02',
        'mercado_id'=>$mer->id,
    ]);

    $campos = $mer->campos;

    $this->assertEquals(2, $campos->count());
});

test('Dos campos pueden tener el mismo número', function(){
    $mer1 = Mercado::create([
        'numero'=>'501',
    ]);

    $mer2 = Mercado::create([
        'numero'=>'601',
    ]);

    Campo::create([
        'numero'=>'01',
        'mercado_id'=>$mer1->id,
    ]);

    Campo::create([
        'numero'=>'01',
        'mercado_id'=>$mer2->id,
    ]);

    $this->assertDatabaseHas('campos', ['numero'=>'01', 'mercado_id'=>$mer1->id]);
    $this->assertDatabaseHas('campos', ['numero'=>'01', 'mercado_id'=>$mer2->id]);
});