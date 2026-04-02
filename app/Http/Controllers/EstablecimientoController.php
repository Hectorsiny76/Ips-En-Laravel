<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Mercadogerente;
use App\Models\Establecimientotipo;
use App\Models\Mercado;
use App\Models\Campo;
use App\Models\Campogerente;
use App\Models\Tidelprograma;
use App\Models\Tiendaformato;
use App\Models\Establecimiento;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $estados = Estado::all();

        $estTipo = Establecimientotipo::findOrFail($request->establecimientotipo_id);
        $campoGerentes = Campogerente::all();
        $tiendaformatos = Tiendaformato::all();

        return view('establecimientos.create', compact('estTipo', 'campoGerentes', 'tiendaformatos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Establecimiento $establecimiento)
    {
        $estTipo = Establecimientotipo::all();
        $campoGerentes = Campogerente::all();
        $tiendaformatos = Tiendaformato::all();

        return view('establecimientos.create', compact('estTipo', 'campoGerentes', 'tiendaformatos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}
