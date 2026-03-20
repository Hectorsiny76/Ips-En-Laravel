<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Establecimiento;
use App\Models\Tidelprograma;

uses(RefreshDatabase::class);

test('Un establecimiento puede ver su programa tidel en caso de tener', function(){
    $programatidel = Tidelprograma::factory()->create();

    $est = Establecimiento::factory()->create(['tidelprograma_id'=>$programatidel]);

    $ip = $est->tidelprograma;

    $this->assertEquals(1, $ip->count());
});

test('Un programa tidel puede ver a qué establecimiento pertenece', function(){
    $programatidel = Tidelprograma::factory()->create();

    Establecimiento::factory()->create(['tidelprograma_id'=>$programatidel]);

    $ip = $programatidel->tidelprograma;

    $this->assertEquals(1, $ip->count());
});