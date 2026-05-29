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
        $cajatipos = Cajatipo::withCount('establecimientos')->get();

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
            'establecimientos' => 'nullable|array',
            'establecimientos.*' => 'required|exists:establecimientos,id',
            'establecimientos.*.numcaja' => 'required|string|min:1',
        ]);

        $cajatipo = Cajatipo::create([
            'nombre' => $request->nombre,
        ]);

        $cajatipo->establecimientos()->sync($request->input('establecimientos'), []);

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

        $cajatipo->load('establecimientos');

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
            'establecimientos' => 'nullable|array',
            'establecimientos.*' => 'required|exists:establecimientos,id',
            'establecimientos.*.numcaja' => 'required|string|min:1',
        ]);

        $cajatipo->update([
            'nombre' => $request->nombre,
        ]);

        $cajatipo->establecimientos()->sync($request->input('establecimientos', []));

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
