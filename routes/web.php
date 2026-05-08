<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AvaloncontratoController;
use App\Http\Controllers\Admin\BinomioestablecimientoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FolioController;
use App\Http\Controllers\Admin\FoliotipoController;
use App\Http\Controllers\Admin\PilotoprogramaController;
use App\Http\Controllers\Admin\TidelprogramaController;
use App\Http\Controllers\Admin\TiendaformatoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CajatipoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\EstadoController;
use App\Http\Controllers\Admin\MercadogerenteController;
use App\Http\Controllers\Admin\EstablecimientotipoController;
use App\Http\Controllers\Admin\MercadoController;
use App\Http\Controllers\Admin\CampoController;
use App\Http\Controllers\Admin\CampogerenteController;
use App\Http\Controllers\Admin\EstablecimientoController;
use App\Http\Controllers\Admin\DespliegueController;
use App\Http\Controllers\Admin\AsociadoController;

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

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin_layout.dashboard');

    // Estado & Mercadogerentes
    Route::resource('estados', EstadoController::class);
    Route::resource('estados.gerentes-mercado', MercadogerenteController::class)->shallow();

    // Mercadogerentes & Mercado
    Route::resource('gerentes-mercado.mercados', MercadoController::class)->shallow();

    // Mercados y campos
    Route::resource('mercados.campos', CampoController::class)->shallow();

    // Campo y Campogerente
    Route::resource('campo.campo-gerente', CampogerenteController::class)->shallow();

    // Tidelprogramas
    Route::resource('tidel-programas', TidelprogramaController::class);

    // Tiendaformatos
    Route::resource('tienda-formatos', TiendaformatoController::class);

    // Avalon contratos
    Route::resource('avalon-contratos', AvaloncontratoController::class);

    // Campogerente y Establecimientos
    Route::resource('campo-gerente.establecimientos', EstablecimientoController::class)->shallow();

    // Establecimientos Binomio
    Route::resource('binomioestablecimientos', BinomioestablecimientoController::class);

    // Programas Piloto
    Route::resource('programas-piloto', PilotoprogramaController::class);

    // Caja Tipos (Ej: Autocobro)
    Route::resource('caja-tipos', CajatipoController::class);

    // Establecimientotipos
    Route::resource('establecimientotipo', EstablecimientotipoController::class);

    // Foliotipos
    Route::resource('foliotipos', FoliotipoController::class);

    // Folios
    Route::resource('foliotipos.folios', FolioController::class)->shallow();

    // Areas
    Route::resource('areas', AreaController::class);

    // Asociados
    Route::resource('areas.asociados', AsociadoController::class)->shallow();

    // Despligues
    Route::resource('despliegues', DespliegueController::class);
});

require __DIR__.'/auth.php';
