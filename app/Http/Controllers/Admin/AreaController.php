<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AreaController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.areas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|min:3|max:50',
            'descripcion' => 'required|string|min:5|max:255',
        ]);

        Area::create($validacion);

        return redirect()->route('admin.areas.index')->with('success', 'Área creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);

        return view('admin.areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);

        $validacion = $request->validate([
            'nombre' => 'required|string|min:3|max:50',
            'descripcion' => 'required|string|min:5|max:255',
        ]);

        $area->update($validacion);

        return redirect()->route('admin.areas.index')->with('success', 'Área '.$area->nombre.' actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $area = Area::findOrFail($id);

        $areaEliminada = $area;

        $area->delete();

        return redirect()->route('admin.areas.index')->with('success', 'Se ha eliminado el area '.$areaEliminada->nombre);
    }
}
