<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Estado;
use App\Models\Mercadogerente;

uses(RefreshDatabase::class);

test('Un estado existe en la base de datos', function(){
    Estado::create([
        'nombre'=>'San Luis Potosi',
    ]);

    $this->assertDatabaseHas('estados', ['nombre'=>'San Luis Potosi']);
});

test('Un estado puede estar agregado a un gerente de mercado', function(){
    $est = Estado::factory()->create();
    Mercadogerente::factory()->create([
        'estado_id' => $est->id,
    ]);

    $this->assertDatabaseHas('mercadogerentes', ['estado_id'=>$est->id]);
});

test('Un estado puede ver sus gerente de mercado', function(){
    $est = Estado::factory()->create();

    Mercadogerente::factory()->create([
        'estado_id' => $est->id,
    ]);

    Mercadogerente::factory()->create([
        'estado_id'=>$est->id,
    ]);


    $mercadosest = $est->mercadogerentes;

    $this->assertEquals(2, $mercadosest->count());
});

test('Un gerente de mercado puede ver su estado', function(){
    $est = Estado::factory()->create();

    $merGer = Mercadogerente::factory()->create(['estado_id'=>$est->id]);
    
    $estGer = $merGer->estado;

    $this->assertEquals($est->id, $estGer->id);
});
