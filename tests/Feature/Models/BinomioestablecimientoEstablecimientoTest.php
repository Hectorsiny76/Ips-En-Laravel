<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Binomioestablecimiento;
use App\Models\Establecimiento;

use App\Models\Establecimientotipo;
use App\Models\Mercado;
use App\Models\Campo;
use App\Models\Campogerente;

uses(RefreshDatabase::class);

test('Un establecimiento binomio puede existir en la base de datos', function(){
        $est1 = Establecimiento::factory()->create();
        $est2 = Establecimiento::factory()->create();

        Binomioestablecimiento::factory()->create(['tienda_id'=>$est1->id, 'estacion_id'=>$est2->id]);

        $this->assertDatabaseCount('binomioestablecimientos',1);
});

test('Un establecimiento NO puede ser binomio consigo mismo',function(){
    $est = Establecimiento::factory()->create();

    Binomioestablecimiento::factory()->create(['tienda_id'=>$est->id, 'estacion_id'=>$est->id]);
})->throws(\Exception::class,'Un establecimiento no puede ser binomio consigo mismo!');

test('Un establecimiento binomio puede ver su tienda',function(){
    $estTipo1 = Establecimientotipo::factory()->create(['nombre'=>'Tienda']);
    $estTipo2 = Establecimientotipo::factory()->create(['nombre'=>'Estacion']);

    $mercado1 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo1->id]);
    $mercado2 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo2->id]);

    $campo1 = Campo::factory()->create(['mercado_id'=>$mercado1->id]);
    $campo2 = Campo::factory()->create(['mercado_id'=>$mercado2->id]);

    $campGer1 = Campogerente::factory()->create(['campo_id'=>$campo1->id]);
    $campGer2 = Campogerente::factory()->create(['campo_id'=>$campo2->id]);

    $est1 = Establecimiento::factory()->create(['campogerente_id'=>$campGer1->id]);
    $est2 = Establecimiento::factory()->create(['campogerente_id'=>$campGer2->id]);

    $binomio = Binomioestablecimiento::factory()->create(['tienda_id'=>$est1->id, 'estacion_id'=>$est2->id]);

    $relacion = $binomio->tienda();

    // Prove it is configured as a BelongsTo relationship
    $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relacion);

    // Prove you typed the foreign key correctly in the model method
    $this->assertEquals('tienda_id', $relacion->getForeignKeyName());

    // Prove it is looking at the 'id' column on the 'professors' table
    $this->assertEquals('establecimientos.id', $relacion->getQualifiedOwnerKeyName());

    $this->assertInstanceOf(Establecimiento::class, $binomio->tienda);
    $this->assertEquals($est1->id, $binomio->tienda->id);
    $this->assertNotEquals($est2->id, $binomio->tienda->id);
});

test('Un establecimiento binomio puede ver su estacion',function(){

    $estTipo1 = Establecimientotipo::factory()->create(['nombre'=>'Tienda']);
    $estTipo2 = Establecimientotipo::factory()->create(['nombre'=>'Estacion']);

    $mercado1 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo1->id]);
    $mercado2 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo2->id]);

    $campo1 = Campo::factory()->create(['mercado_id'=>$mercado1->id]);
    $campo2 = Campo::factory()->create(['mercado_id'=>$mercado2->id]);

    $campGer1 = Campogerente::factory()->create(['campo_id'=>$campo1->id]);
    $campGer2 = Campogerente::factory()->create(['campo_id'=>$campo2->id]);

    $est1 = Establecimiento::factory()->create(['campogerente_id'=>$campGer1->id]);
    $est2 = Establecimiento::factory()->create(['campogerente_id'=>$campGer2->id]);

    $binomio = Binomioestablecimiento::factory()->create(['tienda_id'=>$est1->id, 'estacion_id'=>$est2->id]);

    //dd($binomio->binomioestacion->toSql());

    $relacion = $binomio->estacion();

    // Prove it is configured as a BelongsTo relationship
    $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relacion);

    // Prove you typed the foreign key correctly in the model method
    $this->assertEquals('estacion_id', $relacion->getForeignKeyName());

    // Prove it is looking at the 'id' column on the 'professors' table
    $this->assertEquals('establecimientos.id', $relacion->getQualifiedOwnerKeyName());

    $this->assertInstanceOf(Establecimiento::class, $binomio->estacion);
    $this->assertEquals($est2->id, $binomio->estacion->id);
    $this->assertNotEquals($est1->id, $binomio->estacion->id);
});

test('Una tienda puede ver si tiene estación', function(){
    $estTipo1 = Establecimientotipo::factory()->create(['nombre'=>'Tienda']);
    $estTipo2 = Establecimientotipo::factory()->create(['nombre'=>'Estacion']);

    $mercado1 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo1->id]);
    $mercado2 = Mercado::factory()->create(['establecimientotipo_id'=>$estTipo2->id]);

    $campo1 = Campo::factory()->create(['mercado_id'=>$mercado1->id]);
    $campo2 = Campo::factory()->create(['mercado_id'=>$mercado2->id]);

    $campGer1 = Campogerente::factory()->create(['campo_id'=>$campo1->id]);
    $campGer2 = Campogerente::factory()->create(['campo_id'=>$campo2->id]);

    $est1 = Establecimiento::factory()->create(['campogerente_id'=>$campGer1->id]);
    $est2 = Establecimiento::factory()->create(['campogerente_id'=>$campGer2->id]);

    $binomio = Binomioestablecimiento::factory()->create(['tienda_id'=>$est1->id, 'estacion_id'=>$est2->id]);

    $relacion = $est1->binomiotienda();

    $this->assertEquals($binomio->tienda->id, $est1->binomiotienda->id);
    $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $relacion);
    $this->assertInstanceOf(Binomioestablecimiento::class, $est1->binomiotienda);
    $this->assertEquals($est2->id, $est1->binomiotienda->estacion->id);

});

test('Una estacion puede ver si tiene tienda', function(){
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

    $binomio = Binomioestablecimiento::factory()->create(['tienda_id'=>$est1->id, 'estacion_id'=>$est2->id]);

    $relacion = $est2->binomioestacion();

    $this->assertEquals($binomio->id, $est2->binomioestacion->id);
    $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $relacion);
    $this->assertInstanceOf(Binomioestablecimiento::class, $est2->binomioestacion);
    $this->assertEquals($est1->id, $est2->binomioestacion->tienda->id);

});

