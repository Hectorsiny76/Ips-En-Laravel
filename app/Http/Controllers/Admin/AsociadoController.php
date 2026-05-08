<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Asociado;
use Illuminate\Http\Request;

class AsociadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $area = Area::findOrFail($id);

        $area->load('asociados');

        $asociados = $area->asociados;

        return view('admin.asociados.index', compact('area', 'asociados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $area = Area::findOrFail($id);

        return view('admin.asociados.create', compact('area'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $area = Area::findOrFail($id);

        $validacion = $request->validate([
           'nombre' => 'required|string|min:5|max:50',
           'tel' => 'nullable|min:10|max:15',
            'email' => 'nullable|string|email|max:255',
        ]);

        $area->asociados()->create($validacion);

        return redirect()->route('admin.areas.asociados.index', $area->id)->with('success', 'Se ha registrado el asociado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asociado $asociado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $asociado = Asociado::findOrFail($id);

        return view('admin.asociados.edit', compact('asociado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $asociado = Asociado::findOrFail($id);

        $validacion = $request->validate([
            'nombre' => 'required|string|min:5|max:50',
            'tel' => 'nullable|min:10|max:15',
            'email' => 'nullable|string|email|max:255',
        ]);

        $asociado->update($validacion);

        return redirect()->route('admin.areas.asociados.index', $asociado->area->id)->with('success', 'Se ha actualizado el asociado '.$asociado->nombre.' exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asociado = Asociado::findOrFail($id);

        $asociadoEliminado = $asociado;

        $asociado->delete();

        return redirect()->route('admin.areas.asociados.index', $asociadoEliminado->area->id)->with('success', 'Se a eliminado el asociado '.$asociadoEliminado->nombre.' exitosamente');
    }
}
