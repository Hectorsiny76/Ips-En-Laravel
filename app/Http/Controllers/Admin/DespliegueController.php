<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Despliegue;
use Illuminate\Http\Request;

class DespliegueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.despliegues.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();

        return view('admin.despliegues.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
           'titulo' => 'required|string|min:3|max:255',
            'descripcion' => 'required|string|min:10|max:255',
            'area_id' => 'required|integer|exists:areas,id',
            'inicio' => 'required|date',
            'fin' => 'required|date|after_or_equal:inicio',
        ]);

        $despliegue = Despliegue::create($validacion);

        return redirect()->route('admin.despliegues.index')->with('success', 'Se ha creado el Despliegue '.$despliegue->titulo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Despliegue $despliegue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $despliegue = Despliegue::findOrFail($id);

        $areas = Area::all();

        return view('admin.despliegues.edit', compact('despliegue', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $despliegue = Despliegue::findOrFail($id);

        $validacion = $request->validate([
            'titulo' => 'required|string|min:3|max:255',
            'descripcion' => 'required|string|min:10|max:255',
            'area_id' => 'required|integer|exists:areas,id',
            'inicio' => 'required|date',
            'fin' => 'required|date|after_or_equal:inicio',
        ]);

        $despliegue->update($validacion);

        return redirect()->route('admin.despliegues.index')->with('success', 'Se ha actualizado el Despliegue '.$despliegue->titulo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $despliegue = Despliegue::findOrfail($id);

        $despliegueEliminado = $despliegue;

        $despliegue->delete();

        return redirect()->route('admin.despliegues.index')->with('success', 'Se ha eliminado el Despliegue '.$despliegueEliminado->titulo);
    }
}
