<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Categoria;
use App\Models\Clasificacione;

uses(RefreshDatabase::class);

test('Una categoria existe en la base de datos', function () {
    Categoria::create(['nombre' => 'Gestion Infraestructura']);

    $this->assertDatabaseHas('categorias', ['nombre' => 'Gestion Infraestructura']);
});

test('Una categoria NO puede ser asignada a una clasificacion sin subcategoria, servicio o microservicio', function() {

    $cat = Categoria::create(['nombre' => 'Gestion Infraestructura']);

    Clasificacione::create(['categoria_id' => $cat->id]);
})->throws(QueryException::class);

test('Una categoria puede ser "eliminada"', function(){
    $cat = Categoria::factory()->create();

    $cat->delete();

    $this->assertSoftDeleted($cat);
    $this->assertEquals(0, Categoria::count());
});