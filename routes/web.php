<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\EstablecimientoController;

Route::resource('/', EstablecimientoController::class);

Route::get('/establecimiento/{establecimiento}', [App\Http\Controllers\user\EstablecimientoController::class, 'show'])->name('user.main.show');

Route::get('/', [EstablecimientoController::class, 'index'])->name('main.index');



