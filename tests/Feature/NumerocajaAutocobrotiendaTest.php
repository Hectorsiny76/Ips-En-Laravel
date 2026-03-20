<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Numerocaja;
use App\Models\Autocobrotienda;
use App\Models\Establecimiento;
use Database\Factories\DrivethrutiendaFactory;

uses(RefreshDatabase::class);

test('Una tienda con caja autocobro puede existir en la base de datos', function(){
    Autocobrotienda::factory()->create();

    $this->assertDatabaseCount('autocobrotiendas', 1);
});

test('Una tienda autocobro no puede no tener numero de caja', function(){
    Autocobrotienda::factory()->create(['numerocaja_id'=>null]);
})->throws(QueryException::class);

test('Una tienda con autocobro puede no tener tienda asignada', function(){
    Autocobrotienda::factory()->create(['establecimiento_id'=>null]);

    $this->assertDatabaseCount('autocobrotiendas', 1);
});

test('Un establecimiento puede ver sus cajas autocobro',function(){
    $est = Establecimiento::factory()->create();

    Autocobrotienda::factory()->count(5)->create(['establecimiento_id'=>$est->id]);

    $cajasautocobro = $est->autocobrocajas;

    $this->assertEquals(5, $cajasautocobro->count());
});

test('Un numero de caja puede ver sus derivados de autocobro', function(){
    $num = Numerocaja::factory()->create();

    Autocobrotienda::factory()->count(5)->create(['numerocaja_id'=>$num->id]);

    $tiendas = $num->autocobrotiendas;

    $this->assertEquals(5, $tiendas->count());
});