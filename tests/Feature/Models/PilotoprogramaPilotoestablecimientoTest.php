<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Pilotoestablecimiento;
use App\Models\Pilotoprograma;
use App\Models\Establecimiento;

uses(RefreshDatabase::class);


test('Un piloto programa puede existir en la base de datos', function(){
    Pilotoprograma::factory()->create();

    $this->assertDatabaseCount('pilotoprogramas', 1);
});

test('Un piloto programa puede pertenecer a una tienda', function(){
    $est = Establecimiento::factory()->create();

    $pp = Pilotoprograma::factory()->create();

    Pilotoestablecimiento::factory()->create(['establecimiento_id'=>$est->id, 'pilotoprograma_id'=>$pp->id]);

    $this->assertDatabaseCount('pilotoestablecimientos', 1);
});

test('Un piloto programa TIENE QUE tener titulo', function(){
    Pilotoprograma::factory()->create(['titulo'=>null]);
})->throws(QueryException::class);

test('Un piloto programa puede no tener un establecimiento', function(){
    Pilotoestablecimiento::factory()->create(['establecimiento_id'=>null]);

    $this->assertDatabaseCount('pilotoestablecimientos', 1);
});

test('Un piloto programa puede tener muchos establecimientos', function(){
    $pp = Pilotoprograma::factory()->create();

    $est1 = Establecimiento::factory()->create();

    $est2 = Establecimiento::factory()->create();

    Pilotoestablecimiento::factory()->create(['pilotoprograma_id'=>$pp->id, 'establecimiento_id'=>$est1->id]);
    Pilotoestablecimiento::factory()->create(['pilotoprograma_id'=>$pp->id, 'establecimiento_id'=>$est2->id]);

    $ests = $pp->establecimientos;

    $this->assertEquals(2, $ests->count());
});

test('Un piloto establecimiento puede ver su programa piloto', function(){
    $pe = Pilotoestablecimiento::factory()->create();

    $pp = $pe->pilotoprograma;

    $this->assertEquals(1, $pp->count());
});