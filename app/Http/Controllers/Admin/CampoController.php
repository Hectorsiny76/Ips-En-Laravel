<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campo;
use Illuminate\Http\Request;
use App\Models\Mercado;

class CampoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $mercado = Mercado::find($id);

        $mercado->load('campos.campogerente');

        $campos = $mercado->campos;

        return view('admin.campos.index', compact('campos', 'mercado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Mercado $mercado)
    {
        return view('admin.campos.create', compact('mercado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validacion = $request->validate([
            'numero' => 'required|string|min:1|max:10',
        ]);

        $mercado = Mercado::findOrFail($id);

        $mercado->campos()->create($validacion);

        return redirect()->route('admin.mercados.campos.index', $mercado->id)->with('success', 'Campo agregado correctamente en el mercado '.$mercado->numero);
    }

    /**
     * Display the specified resource.
     */
    public function show(Campo $campo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campo $campo)
    {
        return view('admin.campos.edit', compact('campo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validacion = $request->validate([
            'numero' => 'required|string|min:1|max:10',
        ]);

        $campo = Campo::findOrFail($id);

        $campo->update($validacion);

        return redirect()->route('admin.mercados.campos.index', $campo->mercado->id)->with('success', 'Campo actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $campo = Campo::findOrFail($id);


    }
}
