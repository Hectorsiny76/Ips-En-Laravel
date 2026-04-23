<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binomioestablecimiento;
use App\Models\Establecimientotipo;
use Illuminate\Http\Request;

class BinomioestablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estBinomios = Binomioestablecimiento::with(['tienda', 'estacion'])->get();

        return view('admin.binomioestablecimientos.index', compact('estBinomios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estTiendas = Establecimientotipo::findOrFail(1);

        $estEstaciones = Establecimientotipo::findOrFail(2);

        $estTiendas->load('establecimientos');

        $estEstaciones->load('establecimientos');

        $tiendasTot = $estTiendas->establecimientos;

        $estacionesTot = $estEstaciones->establecimientos;

        $tiendas = $tiendasTot->filter(fn($tienda) => is_null($tienda -> binomioestacion))->pluck('nombre', 'id');

        $estaciones = $estacionesTot->filter(fn($estacion) => is_null($estacion -> binomiotienda))->pluck('nombre', 'id');

        return view('admin.binomioestablecimientos.create', compact('tiendas', 'estaciones'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'tienda_id' => 'required|numeric|exists:establecimientos,id',
            'estacion_id' => 'required|numeric|exists:establecimientos,id',
        ]);

        Binomioestablecimiento::create($validacion);

        return redirect()->route('admin.binomioestablecimientos.index')->with('success', '¡Se ha creado el numero duo de establecimientos!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Binomioestablecimiento $binomioestablecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Binomioestablecimiento $binomioestablecimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Binomioestablecimiento $binomioestablecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Binomioestablecimiento $binomioestablecimiento)
    {
        //
    }
}
