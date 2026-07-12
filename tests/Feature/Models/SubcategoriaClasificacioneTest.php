<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Subcategoria;
use App\Models\Clasificacione;

uses(RefreshDatabase::class);

test('Una categoria existe en la base de datos', function () {
    Subcategoria::create(['nombre' => 'Base de datos']);

    $this->assertDatabaseHas('subcategorias', ['nombre' => 'Base de datos']);
});

test('Una Subcategoria NO puede ser asignada a una clasificacion sin categoria, servicio o microservicio', function() {

    $subCat = Subcategoria::create(['nombre' => 'Base de Datos']);

    Clasificacione::create(['subcategoria_id' => $subCat->id]);
})->throws(QueryException::class);
