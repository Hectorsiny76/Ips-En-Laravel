<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cajatipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CajatipoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cajatipos = Cajatipo::latest()->get();

        return view('admin.caja-tipos.index', compact('cajatipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.caja-tipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:cajatipos',
        ]);

        Cajatipo::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('admin.caja-tipos.index')->with('success', 'Nuevo tipo de caja creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cajatipo $cajatipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cajatipo = Cajatipo::findOrFail($id);

        return view('admin.caja-tipos.edit', compact('cajatipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cajatipo = Cajatipo::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|unique:cajatipos,nombre,'.$cajatipo->id,
        ]);

        $cajatipo->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('admin.caja-tipos.index')->with('success', 'Tipo de caja actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $cajatipo = Cajatipo::findOrFail($id);

        $cajatipo->delete();

        return redirect()->route('admin.caja-tipos.index')->with('success', 'Tipo de caja eliminado');
    }
}
