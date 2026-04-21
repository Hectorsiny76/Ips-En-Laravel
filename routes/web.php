<?php

use App\Http\Controllers\Admin\AvaloncontratoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TidelprogramaController;
use App\Http\Controllers\Admin\TiendaformatoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\EstadoController;
use App\Http\Controllers\Admin\MercadogerenteController;
use App\Http\Controllers\Admin\EstablecimientotipoController;
use App\Http\Controllers\Admin\MercadoController;
use App\Http\Controllers\Admin\CampoController;
use App\Http\Controllers\Admin\CampogerenteController;
use App\Http\Controllers\Admin\EstablecimientoController;

Route::get('/', function () {
    return view('welcome');
});

//Route::post('/', [RegisteredUserController::class, 'index'])->name('register');

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

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

    //Mercados y campos
    Route::resource('mercados.campos', CampoController::class)->shallow();

    //Campo y Campogerente
    Route::resource('campo.campo-gerente', CampogerenteController::class)->shallow();

    //Tidelprogramas
    Route::resource('tidel-programas', TidelprogramaController::class);

    //Tiendaformatos
    Route::resource('tienda-formatos', TiendaformatoController::class);

    //Avalon contratos
    Route::resource('avalon-contratos', AvaloncontratoController::class);

    //Campogerente y Establecimientos
    Route::resource('campo-gerente.establecimientos', EstablecimientoController::class)->shallow();

    // Establecimientotipos
    Route::resource('establecimientotipo', EstablecimientotipoController::class);
    //Route::get('/tipoestablecimiento/{id}', [EstablecimientotipoController::class, 'show'])->name('establecimientotipo.show');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
