<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avaloncontrato;
use App\Models\Establecimiento;
use App\Models\Establecimientotipo;
use App\Models\Estatus;
use Illuminate\Http\Request;

class AvaloncontratoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avaloncontratos = Avaloncontrato::all();

        $avaloncontratos->load('establecimiento', 'estatus');

        return view('admin.avalon-contratos.index', compact('avaloncontratos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estatuses = Estatus::all();

        $tipoEstacion = Establecimientotipo::findOrFail(2);

        $tipoEstacion->load('establecimientos')->get();

        $estaciones = $tipoEstacion->establecimientos;

        $estacionesSinContrato = $estaciones->filter(fn($estaciones) => is_null($estaciones -> avaloncontrato))->pluck('nombre', 'id');

        return view('admin.avalon-contratos.create', compact('estatuses', 'estacionesSinContrato'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'numero' => 'required|string|min:1|max:255|unique:avaloncontratos,numero',
            'estatus_id' => 'required|integer|exists:estatuses,id',
            'establecimiento_id' => 'required|integer|exists:establecimientos,id',
        ],['numero.unique' => 'Este número de contrato ya ha sido registrado']);

        Avaloncontrato::create($validacion);

        return redirect()->route('admin.avalon-contratos.index')->with('success', 'Se ha creado correctamente el contrato');
    }

    /**
     * Display the specified resource.
     */
    public function show(Avaloncontrato $avaloncontrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $avaloncontrato = Avaloncontrato::findOrFail($id);

        $estatuses = Estatus::all();

        $tipoEstacion = Establecimientotipo::findOrFail(2);

        $tipoEstacion->load('establecimientos')->get();

        $estaciones = $tipoEstacion->establecimientos;

        $estacionesSinContrato = $estaciones->filter(fn($estacion) => is_null($estacion -> avaloncontrato) || $estacion->avaloncontrato?->id == $avaloncontrato->id)->pluck('nombre', 'id');

        return view('admin.avalon-contratos.edit', compact('avaloncontrato', 'estatuses', 'estacionesSinContrato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $avaloncontrato = Avaloncontrato::findOrFail($id);

        $validacion = $request->validate([
            'numero' => 'required|string|min:1|max:255|unique:avaloncontratos,numero,'.$avaloncontrato->id,
            'estatus_id' => 'required|integer|exists:estatuses,id',
            'establecimiento_id' => 'required|integer|exists:establecimientos,id',
        ],['numero.unique' => 'Este número de contrato ya ha sido registrado']);

        $avaloncontrato->update($validacion);

        return redirect()->route('admin.avalon-contratos.index')->with('success', 'Se ha actualizado correctamente el contrato '.$avaloncontrato->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $avaloncontrato = Avaloncontrato::findOrFail($id);

        if($avaloncontrato->establecimiento()->exists()){
            return redirect()->route('admin.avalon-contratos.index')->with('error', 'No se puede eliminar este contrato debido a que tiene una estación a su nombre.');
        }

        $avaloncontrato->delete();

        return redirect()->route('admin.avalon-contratos.index')->with('success', 'Se ha eliminado correctamente el contrato');
    }
}
