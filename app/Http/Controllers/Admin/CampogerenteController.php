<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campo;
use App\Models\Campogerente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CampogerenteController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $campo = Campo::findOrFail($id);

        $campo->load('campogerente');

        if(!$campo->campogerente()->exists()){
            return redirect()->route('admin.campo.campo-gerente.create', $campo->id)->with('error', 'No hay gerente de campo asignado, cree uno para este campo');
        }

        $campogerente = $campo->campogerente;

        return view('admin.campo-gerente.index', compact('campo', 'campogerente'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {

        $campo = Campo::findOrFail($id);

        return view('admin.campo-gerente.create', compact('campo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
            'tel' => 'required|min:10|max:15',
            'correo' => 'required|string|email|max:255|unique:campogerentes,correo',
        ],['correo.unique' => 'Este correo ya está registrado.']);

        $campo = Campo::findOrFail($id);

        $campo->campogerente()->create($validacion);

        return redirect()->route('admin.campo.campo-gerente.index', $campo->id)->with('success', 'Gerente de campo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campogerente $campogerente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $campo = Campo::findOrFail($id);

        return view('admin.campo-gerente.edit', compact('campo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campo = Campo::with('campogerente')->findOrFail($id);

        $campogerente = $campo->campogerente;

        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
            'tel' => 'required|min:10|max:15',
            'correo' => 'required|string|email|max:255|unique:campogerentes,correo,'.$campogerente->id,
        ],['correo.unique' => 'Este correo ya está registrado.']);

        $campogerente->update($validacion);

        return redirect()->route('admin.campo.campo-gerente.index', $campo->id)->with('success', 'Gerente de campo creado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $campogerente = Campogerente::findOrFail($id);

        $gerenteEliminado = $campogerente;

        $campogerente->delete();

        return redirect()->route('admin.mercados.campos.index', $gerenteEliminado->campo->mercado->id)->with('success', 'Gerente de campo eliminado correctamente');
    }
}
