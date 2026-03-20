<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Numerocaja;
use App\Models\Drivethrutienda;
use App\Models\Establecimiento;
use Database\Factories\DrivethrutiendaFactory;

uses(RefreshDatabase::class);

test('Una caja puede existir en la base de datos', function(){
    Numerocaja::factory()->create();

    $this->assertDatabaseCount('numerocajas', 1);
});

test('Una caja drivethru puede existir en la base de datos', function(){
    Drivethrutienda::factory()->create();

    $this->assertDatabaseCount('drivethrutiendas', 1);
});

test('No pueden haber 2 cajas numero "2" en la tabla numerocajas', function(){
    Numerocaja::factory()->create(['caja'=>2]);
    Numerocaja::factory()->create(['caja'=>2]);
})->throws(QueryException::class);

test('No puede existir una caja drivethru sin numero de caja', function(){
    Drivethrutienda::factory()->create(['numerocaja_id'=>null]);
})->throws(QueryException::class);

test('Puede existir una caja drivethru sin tienda', function(){
    Drivethrutienda::factory()->create(['establecimiento_id'=>null]);

    $this->assertDatabaseCount('drivethrutiendas', 1);
});

test('Un número de caja puede ver todas sus tiendas con drivethru', function(){
    $num = Numerocaja::factory()->create();

    Drivethrutienda::factory()->count(5)->create(['numerocaja_id'=>$num->id]);

    $cajasdrivethru = $num->drivethrutiendas;

    $this->assertEquals(5, $cajasdrivethru->count());
});