<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Area;
use App\Models\Asociado;

uses(RefreshDatabase::class);

test('un area puede ser guardada en la base de datos', function () {
    Area::create([
        'nombre' => 'G',
        'descripcion' => 'Generalista MSI'
    ]);

    $this->assertDatabaseHas('areas', ['nombre' => 'G']);
});

test('un area puede traer a sus asociados', function() {
    $area = Area::create(['nombre'=>'SS7', 'descripcion'=>'Soporte en Sitio 7Eleven']);

    Asociado::create([
        'nombre' => 'Fernando Martinez',
        'tel' => '8181818181',
        'area_id' => $area->id
    ]);

    Asociado::create([
        'nombre' => 'Romero Fernandez',
        'tel' => '8282828282',
        'area_id' => $area->id
    ]);

    $asociadoRelacionadoAlArea = $area->asociados;

    $this->assertEquals(2, $asociadoRelacionadoAlArea->count());
});

test('un asociado puede saber su area', function(){
    $area = Area::create(['nombre'=>'BI', 'descripcion'=>'Oracle BI Publisher']);

    $asociado = Asociado::create([
        'nombre'=>'Jorge Referino',
        'tel'=>'9191919191',
        'area_id'=>$area->id,
    ]);

    $areaDelAsociado = $asociado->area;

    $this->assertEquals(1, $areaDelAsociado->count());
});