<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pilotoprograma;
use Illuminate\Http\Request;

class PilotoprogramaController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pilotoProgramas = Pilotoprograma::withCount('establecimientos')->get();

        return view('admin.programas-piloto.index', compact('pilotoProgramas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.programas-piloto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'descripcion_corta' => 'required|string|max:100',
            'descripcion_larga' => 'required|string|max:255',
            'establecimientos' => 'nullable|array',
            'establecimientos.*' => 'exists:establecimientos,id',
        ]);

        $progPiloto = Pilotoprograma::create([
            'titulo' => $request->titulo,
            'descripcion_corta' => $request->descripcion_corta,
            'descripcion_larga' => $request->descripcion_larga,
        ]);

        $progPiloto->establecimientos()->sync($request->input('establecimientos', []));

        return redirect()->route('admin.programas-piloto.index')->with('success', 'El Programa Piloto '.$request->titulo.' fue creado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pilotoprograma $pilotoprograma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pilotoPrograma = Pilotoprograma::find($id);

        $pilotoPrograma->load('establecimientos');

        return view('admin.programas-piloto.edit', compact('pilotoPrograma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pilotoPrograma = Pilotoprograma::find($id);

        $request->validate([
            'titulo' => 'required|string|max:50',
            'descripcion_corta' => 'required|string|max:100',
            'descripcion_larga' => 'required|string|max:255',
            'establecimientos' => 'nullable|array',
            'establecimientos.*' => 'exists:establecimientos,id',
        ]);

        $pilotoPrograma->update([
            'titulo' => $request->titulo,
            'descripcion_corta' => $request->descripcion_corta,
            'descripcion_larga' => $request->descripcion_larga,
        ]);

        $pilotoPrograma->establecimientos()->sync($request->input('establecimientos', []));

        return redirect()->route('admin.programas-piloto.index')->with('success', 'El Programa Piloto '.$pilotoPrograma->titulo.' fue actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pilotoPrograma = Pilotoprograma::find($id);

        $pilotoPrograma->delete();

        $titulo = $pilotoPrograma->titulo;

        return redirect()->route('admin.programas-piloto.index')->with('success', 'El Programa Piloto '.$titulo.' fue eliminado exitosamente!');
    }
}
