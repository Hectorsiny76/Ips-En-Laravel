<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Folio;
use App\Models\Foliotipo;
use Illuminate\Http\Request;

class FolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $folioTipo = FolioTipo::findOrFail($id);

        $folioTipo->load('folios');

        $folios = $folioTipo->folios;

        return view('admin.folios.index', compact('folios', 'folioTipo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $folioTipo = FolioTipo::findOrFail($id);

        return view('admin.folios.create', compact('folioTipo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $folioTipo = FolioTipo::findOrFail($id);

        $validacion = $request->validate([
            'numero' => 'nullable|string|min:8',
            'titulo' => 'required|string|min:10|max:255',
            'descripcion' => 'nullable|string|min:10|max:255',
        ]);

        $folioTipo->folios()->create($validacion);

        return redirect()->route('admin.foliotipos.folios.index', $folioTipo->id)->with('success', '¡Folio agregado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Folio $folio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $folio = Folio::findOrFail($id);

        return view('admin.folios.edit', compact('folio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $folio = Folio::findOrFail($id);

        $validacion = $request->validate([
           'numero' => 'nullable|string|min:8',
           'titulo' => 'required|string|min:10|max:255',
           'descripcion' => 'nullable|string|min:10|max:255',
        ]);

        $folio->update($validacion);

        return redirect()->route('admin.foliotipos.folios.index', $folio->foliotipo->id)->with('success', '¡Se actualizó el Folio!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $folio = Folio::findOrFail($id);

        $folioEliminiado = $folio;

        $folio->delete();

        return redirect()->route('admin.foliotipos.folios.index', $folioEliminiado->foliotipo->id)->with('success', '¡Se eliminó el Folio '.$folioEliminiado->titulo.'!');
    }
}
