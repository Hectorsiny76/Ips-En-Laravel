<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use function Termwind\renderUsing;

class CategoriaController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categorias.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
           'nombre' => 'required|string|max:255',
        ]);

        $categoria = Categoria::create($validacion);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria '.$categoria->nombre.' creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria->update($validacion);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria '.$categoria->nombre.' actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if($categoria->clasificaciones()->count() > 0){
            return redirect()
                ->route('admin.categorias.index')
                ->with('error', 'No se puede eliminar esta categoría porque tiene clasificaciones asignadas!');
        }

        $categoriaEliminada = $categoria;

        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria '.$categoriaEliminada->nombre.' eliminada correctamente');
    }
}
