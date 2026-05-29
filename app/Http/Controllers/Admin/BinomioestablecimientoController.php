<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binomioestablecimiento;
use App\Models\Establecimientotipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BinomioestablecimientoController extends AdminController
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

        $tiendas = $tiendasTot->filter(fn($tienda) => is_null($tienda -> binomiotienda))->pluck('nombre', 'id');

        $estaciones = $estacionesTot->filter(fn($estacion) => is_null($estacion -> binomioestacion))->pluck('nombre', 'id');

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
    public function edit($id){

        $estBinomio = Binomioestablecimiento::findOrFail($id);

        $estTiendas = Establecimientotipo::findOrFail(1);

        $estEstaciones = Establecimientotipo::findOrFail(2);

        $estTiendas->load('establecimientos');

        $estEstaciones->load('establecimientos');

        $tiendasTot = $estTiendas->establecimientos;

        $estacionesTot = $estEstaciones->establecimientos;

        $tiendas = $tiendasTot->filter(fn($tienda) => is_null($tienda -> binomiotienda) || $tienda->id == $estBinomio->tienda_id)->pluck('nombre', 'id');

        $estaciones = $estacionesTot->filter(fn($estacion) => is_null($estacion -> binomioestacion) || $estacion->id == $estBinomio->estacion_id)->pluck('nombre', 'id');

        return view('admin.binomioestablecimientos.edit', compact('tiendas', 'estaciones', 'estBinomio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Binomioestablecimiento $binomioestablecimiento)
    {
        $validacion = $request->validate([
            'tienda_id' => 'required|numeric|exists:establecimientos,id',
            'estacion_id' => 'required|numeric|exists:establecimientos,id',
        ]);

        $binomioestablecimiento->update($validacion);

        return redirect()->route('admin.binomioestablecimientos.index')->with('success', '¡Se ha actualizado el duo de establecimientos '.$binomioestablecimiento->id.'!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Binomioestablecimiento $binomioestablecimiento)
    {
        Gate::authorize('delete-data-create-users');

        $binomioestablecimiento->delete();

        return redirect()->route('admin.binomioestablecimientos.index')->with('success', '¡Se ha eliminado el duo de establecimientos!');
    }
}
