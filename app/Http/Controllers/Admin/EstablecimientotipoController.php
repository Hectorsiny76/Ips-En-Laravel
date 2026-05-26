<?php

namespace App\Http\Controllers\Admin;

use App\Models\Archivotipo;
use App\Models\Establecimientotipo;
use Illuminate\Http\Request;

class EstablecimientotipoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estTipos = Establecimientotipo::withCount('archivos')->get();

        return view('admin.establecimientotipo.index', compact('estTipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.establecimientotipo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estTipo = Establecimientotipo::findOrFail($id);

        return view('admin.establecimientotipo.show', compact('estTipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estTipo = Establecimientotipo::findOrFail($id);

        return view('admin.establecimientotipo.edit', compact('estTipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Establecimientotipo $establecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Establecimientotipo $establecimiento)
    {
        //
    }
}
