<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Microservicio;
use App\Models\Clasificacione;

uses(RefreshDatabase::class);

test('Un microservicio existe en la base de datos', function () {
    Microservicio::create(['nombre' => 'DB']);

    $this->assertDatabaseHas('microservicios', ['nombre' => 'DB']);
});

test('Un microservicio NO puede ser asignado a una clasificacion sin categoria, subcategoria o servicio', function() {

    $micro = Microservicio::create(['nombre' => 'DB']);

    Clasificacione::create(['microservicio_id' => $micro->id]);
})->throws(QueryException::class);