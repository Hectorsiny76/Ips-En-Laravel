<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\user\EstablecimientoController::class, 'index'])->name('main.index');


