<?php

namespace App\Http\Controllers\Admin;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = Estado::all();

        $columnas = ['Nombre'];

        $columnasDb = ['nombre'];

        return view('admin.estados.index', compact('estados', 'columnas', 'columnasDb'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.estados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Estado::create($validacion);

        return redirect()->route('admin.estados.index')->with('success', 'Estado creado satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estado $estado)
    {
        return view('admin.estados.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estado $estado)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:255'.$estado->id,
        ]);

        $estado->update($validacion);

        return redirect()->route('admin.estados.index')->with('success', 'Estado actualizado satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estado $estado)
    {
        if ($estado->mercadogerentes()->count() > 0) {
            // Bounce them back with an error message instead of deleting
            return redirect()->route('admin.estados.index')
                ->with('error', 'No puedes eliminar este estado debido a que tiene gerentes de mercado asignados. Favor de reasignarlos a otro estado.');
        }

        $estado->delete();

        return redirect()->route('admin.estados.index')->with('success', 'Estado eliminado satisfactoriamente!');
    }
}
