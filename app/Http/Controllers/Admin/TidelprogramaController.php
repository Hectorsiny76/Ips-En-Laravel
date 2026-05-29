<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tidelprograma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TidelprogramaController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tidel-programas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tidel-programas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
           'ip'=>'required|ipv4',
           'fechamigracion'=>'nullable|date|date_format:Y-m-d',
        ]);

        Tidelprograma::create($validacion);

        return redirect()->route('admin.tidel-programas.index')->with('success', 'Se ha añadido una nueva migración a TIDEL correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tidelprograma $tidelprograma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tidelprograma = Tidelprograma::findOrFail($id);

        return view('admin.tidel-programas.edit', compact('tidelprograma'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tidelprograma = Tidelprograma::findOrFail($id);

        $validacion = $request->validate([
            'ip'=>'required|ipv4',
            'fechamigracion'=>'nullable|date|date_format:Y-m-d',
        ]);

        $tidelprograma->update($validacion);

        return redirect()->route('admin.tidel-programas.index')->with('success', 'Se actualizó el programa correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $tidelprograma = Tidelprograma::findOrFail($id);

        $tidelprograma->delete();

        return redirect()->route('admin.tidel-programas.index')->with('success', 'Se eliminó el programa correctamente.');
    }
}
