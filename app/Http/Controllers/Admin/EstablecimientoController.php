<?php

namespace App\Http\Controllers\Admin;

use App\Models\Avaloncontrato;
use App\Models\Cluster;
use App\Models\Estatus;
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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class EstablecimientoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $campogerente = Campogerente::findOrFail($id);

        return view('admin.establecimientos.index', compact('campogerente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $campogerente = Campogerente::findOrFail($id);

        $campogerente->load(['establecimientotipo']);

        $estTipo = $campogerente->establecimientotipo;

        $tiendaformatos = Tiendaformato::all();

        $clusters = Cluster::all();

        $tidelprogramas = Tidelprograma::doesntHave('establecimiento')->pluck('ip', 'id');

        $estTipoNombre = Str::slug($estTipo->nombre);

        return view('admin.establecimientos.create', compact('campogerente', 'estTipo', 'estTipoNombre', 'tiendaformatos', 'tidelprogramas', 'clusters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $campogerente = Campogerente::findOrFail($id);

        $campogerente->load(['establecimientotipo']);

        $estTipo = $campogerente->establecimientotipo;

        $estTipoNombre = Str::slug($estTipo->nombre);

        $validacionesBase = [
            'nombre' => 'required|string|max:255',
            'numero' => 'required|string|min:1|max:10',
            'cajas_tpvs' => 'required|numeric|min:1',
            'idred' => 'required|ip',
        ];

        $validacionesXEstablecimiento = [
            'tienda' => [
                'tiendaformato_id' => 'required|numeric|exists:tiendaformatos,id',
                'tidelprograma_id' => 'nullable|numeric|exists:tidelprogramas,id',
                'cluster_id' => 'required|numeric|exists:clusters,id',
            ],
            'estacion' => [
                'centrodecostos' => 'required|numeric|min:1|unique:establecimientos,centrodecostos',
                'tel' => 'required|min:10|max:15',
                'correo' => 'required|string|email',
            ]
        ];

        $validacionFinal = array_merge($validacionesBase, $validacionesXEstablecimiento[$estTipoNombre] ?? []);

        $validacion = $request->validate($validacionFinal);

        $campogerente->establecimientos()->create($validacion);

        return redirect()->route('admin.campo-gerente.establecimientos.index', $campogerente->id)->with('success', 'El establecimiento para el campo '.$campogerente->campo->numero.' se ha creado correctamente.');
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
    public function edit($id)
    {
        $establecimiento = Establecimiento::findOrFail($id);

        $establecimiento->load(['establecimientotipo', 'tiendaformato', 'tidelprograma', 'cluster']);

        $estTipo = $establecimiento->establecimientotipo;

        $tiendaformatos = Tiendaformato::all();

        $clusters = Cluster::all();

        $tidelprogramas = Tidelprograma::doesntHave('establecimiento')->orWhere('id', $establecimiento->tidelprograma?->id)->pluck('ip', 'id');

        $estTipoNombre = Str::slug($estTipo->nombre);

        return view('admin.establecimientos.edit', compact('establecimiento', 'estTipo', 'tiendaformatos', 'tidelprogramas', 'clusters', 'estTipoNombre' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $establecimiento = Establecimiento::findOrFail($id);

        $establecimiento->load(['establecimientotipo']);

        $estTipo = $establecimiento->establecimientotipo;

        $estTipoNombre = Str::slug($estTipo->nombre);

        $validacionesBase = [
            'nombre' => 'required|string|max:255',
            'numero' => 'required|string|min:1|max:10',
            'cajas_tpvs' => 'required|numeric|min:1',
            'idred' => 'required|ip',
        ];

        $validacionesXEstablecimiento = [
            'tienda' => [
                'tiendaformato_id' => 'required|numeric|exists:tiendaformatos,id',
                'tidelprograma_id' => 'required|numeric|exists:tidelprogramas,id',
                'cluster_id' => 'required|numeric|exists:clusters,id',
            ],
            'estacion' => [
                'centrodecostos' => 'required|numeric|min:1|unique:establecimientos,centrodecostos,'.$establecimiento->id,
                'tel' => 'required|min:10|max:15',
                'correo' => 'required|string|email',
            ]
        ];

        $validacionFinal = array_merge($validacionesBase, $validacionesXEstablecimiento[$estTipoNombre] ?? []);

        $validacion = $request->validate($validacionFinal);

        $establecimiento->update($validacion);

        return redirect()->route('admin.campo-gerente.establecimientos.index', $establecimiento->campogerente->id)->with('success', 'El establecimiento '.$establecimiento->nombre.' se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $establecimiento = Establecimiento::findOrFail($id);

        $establecimientoEliminado = $establecimiento;

        $establecimiento->delete();

        return redirect()->route('admin.campo-gerente.establecimientos.index', $establecimientoEliminado->campogerente->id)->with('success', 'El establecimiento '.$establecimientoEliminado->nombre.' se ha eliminado correctamente.');
    }
}
