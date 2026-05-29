<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Foliotipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FoliotipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foliotipos = Foliotipo::withCount('folios')->get();

        return view('admin.foliotipos.index', compact('foliotipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.foliotipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'tipo' => 'required|unique:foliotipos|max:255',
        ]);

        $foliotipo = Foliotipo::create($validacion);

        return redirect()->route('admin.foliotipos.index')->with('success', 'Folio tipo '.$foliotipo->tipo.' agregado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Foliotipo $foliotipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foliotipo $foliotipo)
    {
        return view('admin.foliotipos.edit', compact('foliotipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foliotipo $foliotipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foliotipo $foliotipo)
    {
        Gate::authorize('delete-data-create-users');

        $folioEliminado = $foliotipo;

        $foliotipo->delete();

        return redirect()->route('admin.foliotipos.index')->with('success', 'Folio tipo '.$folioEliminado->tipo.' eliminado');
    }
}
