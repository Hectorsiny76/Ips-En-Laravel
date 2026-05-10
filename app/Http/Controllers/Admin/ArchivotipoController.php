<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archivotipo;
use Illuminate\Http\Request;

class ArchivotipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $archivotipos = Archivotipo::all();

        return view('admin.archivo-tipos.index', compact('archivotipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.archivo-tipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|min:3',
            'es_link' => 'required|boolean',
            'mimes_permitidos' => 'nullable|string',
            'tam_max_kb' => 'nullable|string',
        ]);

        $archivotipo = Archivotipo::create($validacion);

        return redirect()->route('admin.archivo-tipo.index')->with('success', 'El tipo de archivo '.$archivotipo->nombre.' se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Archivotipo $archivotipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $archivoTipo = Archivotipo::findOrFail($id);

        return view('admin.archivo-tipos.edit', compact('archivoTipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|min:3',
            'es_link' => 'required|boolean',
            'mimes_permitidos' => 'nullable|string',
            'tam_max_kb' => 'nullable|string',
        ]);

        $archivoTipo = Archivotipo::findOrFail($id);

        $archivoTipo->update($validacion);

        return redirect()->route('admin.archivo-tipo.index')->with('success', 'El tipo de archivo '.$archivoTipo->nombre.' se ha actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $archivoTipo = Archivotipo::findOrFail($id);

        $archivoTipoEliminado = $archivoTipo;

        $archivoTipo->delete();

        return redirect()->route('admin.archivo-tipo.index')->with('success', 'El tipo de archivo '.$archivoTipoEliminado->nombre.' se ha eliminado correctamente');
    }
}
