<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clasificacione;
use Illuminate\Http\Request;

class ClasificacioneController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.clasificaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clasificaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lo tiene el componente en la carpeta de livewire/clasificaciones/create-form.blade.php
    }

    /**
     * Display the specified resource.
     */
    public function show(Clasificacione $clasificacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clasificacion = Clasificacione::findOrFail($id);

        $clasificacion->load(['categoria', 'subcategoria', 'servicio', 'microservicio']);

        return view('admin.clasificaciones.edit', compact('clasificacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clasificacione $clasificacione)
    {
        // Lo tiene el componente en la carpeta de livewire/clasificaciones/edit-form.blade.php
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clasificacion = Clasificacione::findOrFail($id);

        $clasificacion->delete();

        return redirect()->route('admin.clasificaciones.index')->with('success', '¡Clasificacion eliminada correctamente!');
    }
}
