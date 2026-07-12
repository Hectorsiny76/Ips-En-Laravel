<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Servicio;
use App\Models\Microservicio;
use App\Models\Clasificacione;

uses(RefreshDatabase::class);

test('Una clasificacion existe en la base de datos', function () {
    //Creamos datos para la llaves foraneas
    $cat = Categoria::create(['nombre' => 'Gestion Infraestructura']);
    $subCat = Subcategoria::create(['nombre' => 'Base de datos']);
    $ser = Servicio::create(['nombre' => 'Soportar DB']);
    $micro = Microservicio::create(['nombre' => 'DB']);

    //Se agregan al crear una clasificacion
    Clasificacione::create([
        'categoria_id' => $cat->id,
        'microservicio_id' => $micro->id,
        'servicio_id' => $ser->id,
        'subcategoria_id' => $subCat->id,
        ]);

    $this->assertDatabaseHas('clasificaciones', ['categoria_id' => $cat->id, 'subcategoria_id' => $subCat->id, 'servicio_id' => $ser->id, 'microservicio_id' => $micro->id]);
});

test('Una categoria puede traer sus clasificaciones', function() {

        //Creamos datos para la llaves foraneas
    $cat = Categoria::create(['nombre' => 'Gestion Infraestructura']);
    $subCat = Subcategoria::create(['nombre' => 'Base de datos']);
    $ser = Servicio::create(['nombre' => 'Soportar DB']);
    $micro = Microservicio::create(['nombre' => 'DB']);

    //Se agregan al crear una clasificacion
    Clasificacione::create([
        'categoria_id' => $cat->id,
        'microservicio_id' => $micro->id,
        'servicio_id' => $ser->id,
        'subcategoria_id' => $subCat->id,
        ]);
    
    //Creamos datos para la llaves foraneas
    $subCat2 = Subcategoria::create(['nombre' => 'Base de datos']);
    $ser2 = Servicio::create(['nombre' => 'Soportar DB']);
    $micro2 = Microservicio::create(['nombre' => 'DB']);

    //Se agregan al crear una clasificacion
    Clasificacione::create([
        'categoria_id' => $cat->id,
        'microservicio_id' => $micro2->id,
        'servicio_id' => $ser2->id,
        'subcategoria_id' => $subCat2->id,
        ]);

    $categoriasConMismaClasificacion = $cat->clasificaciones;
    $this->assertEquals(2, $categoriasConMismaClasificacion->count());
});

test('Una subcategoria puede traer sus clasificaciones', function() {

    //Creamos datos para la llaves foraneas
    $cat = Categoria::create(['nombre' => 'Gestion Infraestructura']);
    $subCat = Subcategoria::create(['nombre' => 'Base de datos']);
    $ser = Servicio::create(['nombre' => 'Soportar DB']);
    $micro = Microservicio::create(['nombre' => 'DB']);

    //Se agregan al crear una clasificacion
    Clasificacione::create([
        'categoria_id' => $cat->id,
        'microservicio_id' => $micro->id,
        'servicio_id' => $ser->id,
        'subcategoria_id' => $subCat->id,
        ]);
    
    //Creamos datos para la llaves foraneas
    $ser2 = Servicio::create(['nombre' => 'Soportar DB']);
    $micro2 = Microservicio::create(['nombre' => 'DB']);

    //Se agregan al crear una clasificacion
    Clasificacione::create([
        'categoria_id' => $cat->id,
        'microservicio_id' => $micro2->id,
        'servicio_id' => $ser2->id,
        'subcategoria_id' => $subCat->id,
        ]);

    $subcategoriasConMismaClasificacion = $subCat->clasificaciones;
    $this->assertEquals(2, $subcategoriasConMismaClasificacion->count());
});

test('Un servicio puede traer sus clasificaciones', function() {

    //Creamos datos para la llaves foraneas
    $cat = Categoria::create(['nombre' => 'Gestion Infraestructura']);
    $subCat = Subcategoria::create(['nombre' => 'Base de datos']);
    $ser = Servicio::create(['nombre' => 'Soportar DB']);
    $micro = Microservicio::create(['nombre' => 'DB']);

    //Se agregan al crear una clasificacion
    Clasificacione::create([
        'categoria_id' => $cat->id,
        'microservicio_id' => $micro->id,
        'servicio_id' => $ser->id,
        'subcategoria_id' => $subCat->id,
    ]);
    
    //Creamos datos para la llaves foraneas
    $micro2 = Microservicio::create(['nombre' => 'DB2']);

    //Se agregan al crear una clasificacion
    Clasificacione::create([
        'categoria_id' => $cat->id,
        'microservicio_id' => $micro2->id,
        'servicio_id' => $ser->id,
        'subcategoria_id' => $subCat->id,
        ]);

    $serviciosConMismaClasificacion = $ser->clasificaciones;
    $this->assertEquals(2, $serviciosConMismaClasificacion->count());
});