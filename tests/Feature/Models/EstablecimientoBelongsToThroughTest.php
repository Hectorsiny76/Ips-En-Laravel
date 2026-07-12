<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Establecimientotipo;
use App\Models\Mercado;
use App\Models\Campo;
use App\Models\Campogerente;
use App\Models\Establecimiento;
use App\Models\Mercadogerente;
use App\Models\Estado;

uses(RefreshDatabase::class);

test('Un establecimiento puede ver su estado/plaza', function(){

    $est = Estado::factory()->create();

    $merGer = Mercadogerente::factory()->create(['estado_id'=>$est]);

    $estTipo1 = Establecimientotipo::factory()->create(['nombre'=>'Tienda']);
    $estTipo2 = Establecimientotipo::factory()->create(['nombre'=>'Estacion']);

    $mercado1 = Mercado::factory()->create(['mercadogerente_id'=>$merGer->id, 'establecimientotipo_id'=>$estTipo1->id]);
    $mercado2 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo2->id]);

    $campo1 = Campo::factory()->create(['mercado_id'=>$mercado1->id]);
    $campo2 = Campo::factory()->create(['mercado_id'=>$mercado2->id]);

    $campGer1 = Campogerente::factory()->create(['campo_id'=>$campo1->id]);
    $campGer2 = Campogerente::factory()->create(['campo_id'=>$campo2->id]);

    $est1 = Establecimiento::factory()->create(['campogerente_id'=>$campGer1->id]); //Tienda
    $est2 = Establecimiento::factory()->create(['campogerente_id'=>$campGer2->id]); //Estacion

    $estado = $est1->estado;

    $this->assertEquals($estTipo1->id, $estado->id);
});



test('Un establecimiento puede ver su gerente de mercado', function(){

    $merGer = Mercadogerente::factory()->create();

    $estTipo1 = Establecimientotipo::factory()->create(['nombre'=>'Tienda']);
    $estTipo2 = Establecimientotipo::factory()->create(['nombre'=>'Estacion']);

    $mercado1 = Mercado::factory()->create(['mercadogerente_id'=>$merGer->id, 'establecimientotipo_id'=>$estTipo1->id]);
    $mercado2 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo2->id]);

    $campo1 = Campo::factory()->create(['mercado_id'=>$mercado1->id]);
    $campo2 = Campo::factory()->create(['mercado_id'=>$mercado2->id]);

    $campGer1 = Campogerente::factory()->create(['campo_id'=>$campo1->id]);
    $campGer2 = Campogerente::factory()->create(['campo_id'=>$campo2->id]);

    $est1 = Establecimiento::factory()->create(['campogerente_id'=>$campGer1->id]); //Tienda
    $est2 = Establecimiento::factory()->create(['campogerente_id'=>$campGer2->id]); //Estacion

    $merGerente = $est1->mercadogerente;

    $this->assertEquals($estTipo1->id, $merGerente->id);
});

test('Un establecimiento puede ver que tipo de establecimiento es', function(){

    $estTipo1 = Establecimientotipo::factory()->create(['nombre'=>'Tienda']);
    $estTipo2 = Establecimientotipo::factory()->create(['nombre'=>'Estacion']);

    $mercado1 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo1->id]);
    $mercado2 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo2->id]);

    $campo1 = Campo::factory()->create(['mercado_id'=>$mercado1->id]);
    $campo2 = Campo::factory()->create(['mercado_id'=>$mercado2->id]);

    $campGer1 = Campogerente::factory()->create(['campo_id'=>$campo1->id]);
    $campGer2 = Campogerente::factory()->create(['campo_id'=>$campo2->id]);

    $est1 = Establecimiento::factory()->create(['campogerente_id'=>$campGer1->id]); //Tienda
    $est2 = Establecimiento::factory()->create(['campogerente_id'=>$campGer2->id]); //Estacion

    $tipo = $est1->establecimientotipo;

    $this->assertEquals($estTipo1->id, $tipo->id);
});

test('Un establecimiento puede ver su mercado', function(){
    $estTipo1 = Establecimientotipo::factory()->create(['nombre'=>'Tienda']);
    $estTipo2 = Establecimientotipo::factory()->create(['nombre'=>'Estacion']);

    $mercado1 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo1->id]);
    $mercado2 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo2->id]);

    $campo1 = Campo::factory()->create(['mercado_id'=>$mercado1->id]);
    $campo2 = Campo::factory()->create(['mercado_id'=>$mercado2->id]);

    $campGer1 = Campogerente::factory()->create(['campo_id'=>$campo1->id]);
    $campGer2 = Campogerente::factory()->create(['campo_id'=>$campo2->id]);

    $est1 = Establecimiento::factory()->create(['campogerente_id'=>$campGer1->id]); //Tienda
    $est2 = Establecimiento::factory()->create(['campogerente_id'=>$campGer2->id]); //Estacion

    $mer = $est1->mercado;

    $this->assertEquals($mercado1->id, $mer->id);
});

test('Un establecimiento puede ver su campo', function(){
    $estTipo1 = Establecimientotipo::factory()->create(['nombre'=>'Tienda']);
    $estTipo2 = Establecimientotipo::factory()->create(['nombre'=>'Estacion']);

    $mercado1 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo1->id]);
    $mercado2 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo2->id]);

    $campo1 = Campo::factory()->create(['mercado_id'=>$mercado1->id]);
    $campo2 = Campo::factory()->create(['mercado_id'=>$mercado2->id]);

    $campGer1 = Campogerente::factory()->create(['campo_id'=>$campo1->id]);
    $campGer2 = Campogerente::factory()->create(['campo_id'=>$campo2->id]);

    $est1 = Establecimiento::factory()->create(['campogerente_id'=>$campGer1->id]); //Tienda
    $est2 = Establecimiento::factory()->create(['campogerente_id'=>$campGer2->id]); //Estacion

    $camp = $est1->campo;

    $this->assertEquals($campo1->id, $camp->id);
});