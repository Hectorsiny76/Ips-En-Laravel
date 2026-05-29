<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subcategorias.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subcategorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $subccategoria = Subcategoria::create($validacion);

        return redirect()->route('admin.subcategorias.index')->with('success', '¡Subcategoria '.$subccategoria->nombre.' creada correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        return view('admin.subcategorias.edit', compact('subcategoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $subcategoria = Subcategoria::findOrFail($id);

        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $subcategoria->update($validacion);

        return redirect()->route('admin.subcategorias.index')->with('success', '¡Subcategoria '.$subcategoria->nombre.' actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $subcategoria = Subcategoria::findOrFail($id);

        $subcategoriaEliminada = $subcategoria;

        $subcategoria->delete();

        return redirect()->route('admin.subcategorias.index')->with('success', 'Categoria '.$subcategoriaEliminada->nombre.' eliminada correctamente');
    }
}
