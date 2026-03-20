<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Servicio;
use App\Models\Clasificacione;

uses(RefreshDatabase::class);

test('Una Sevicio existe en la base de datos', function () {
    Servicio::create(['nombre' => 'Soportar DB']);

    $this->assertDatabaseHas('servicios', ['nombre' => 'Soportar DB']);
});

test('Un servicio NO puede ser asignado a una clasificacion sin categoria, subcategoria o microservicio', function() {

    $ser = Servicio::create(['nombre' => 'Soportar DB']);

    Clasificacione::create(['servicio_id' => $ser->id]);
})->throws(QueryException::class);