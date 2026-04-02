<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MercadogerenteController;
use App\Http\Controllers\EstablecimientotipoController;
use App\Http\Controllers\MercadoController;
use App\Http\Controllers\CampoController;
use App\Http\Controllers\CampogerenteController;
use App\Http\Controllers\EstablecimientoController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth')->group(function () {

    // Registro
    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin_layout.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin_layout.dashboard');

    // Estado & Mercadogerentes
    Route::resource('estados', EstadoController::class);
    Route::resource('estados.gerentes-mercado', MercadogerenteController::class)->shallow();

    //Mercadogerentes & Mercado
    Route::resource('gerentes-mercado.mercados', MercadoController::class)->shallow();


    // Establecimientotipos
    Route::resource('establecimientotipo', EstablecimientotipoController::class);
    //Route::get('/tipoestablecimiento/{id}', [EstablecimientotipoController::class, 'show'])->name('establecimientotipo.show');

    // Establecimientos
    Route::resource('establecimientos', EstablecimientoController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
