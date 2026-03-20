<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Pilotoestablecimiento;
use App\Models\Pilotoprograma;
use App\Models\Establecimiento;

uses(RefreshDatabase::class);

test('Un establecimiento puede pertenecer a un programa piloto', function(){
    $est = Establecimiento::factory()->create();

    Pilotoestablecimiento::factory()->create(['establecimiento_id'=>$est->id]);

    $this->assertDatabaseHas('pilotoestablecimientos', ['establecimiento_id'=>$est->id]);
});

test('Un piloto establecimiento puede ver su establecimiento', function(){
    $pe = Pilotoestablecimiento::factory()->create();

    $est = $pe->establecimiento;

    $this->assertEquals(1, $est->count());
});

test('Un establecimiento puede ver sus programas piloto', function(){
    $est = Establecimiento::factory()->create();

    Pilotoestablecimiento::factory()->count(2)->create(['establecimiento_id'=>$est->id]);

    $programas = $est->pilotoprogramas;

    $this->assertEquals(2, $programas->count());
});

