<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CajatipoEstablecimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CajatipoestablecimientoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cajatipo-establecimientos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cajatipo-establecimientos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // El componente livewire se encarga de guardar los datos create-form
    }

    /**
     * Display the specified resource.
     */
    public function show(CajatipoEstablecimiento $cajatipoEstablecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estCajaTipo = CajatipoEstablecimiento::findOrFail($id);

        $estCajaTipo->load('establecimiento', 'cajatipo');

        return view('admin.cajatipo-establecimientos.edit', compact('estCajaTipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CajatipoEstablecimiento $cajatipoEstablecimiento)
    {
        // El componente livewire se encarga de actualizar los datos edit-form
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $estCajaTipo = CajatipoEstablecimiento::findOrFail($id);

        $estCajaTipo->delete();

        return redirect()->route('admin.cajatipo-establecimiento.index')->with('success', '¡La relación ha sido eliminada!');
    }
}
