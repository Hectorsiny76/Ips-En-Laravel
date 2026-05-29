<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mercadogerente;
use Illuminate\Http\Request;
use App\Models\Estado;
use Illuminate\Support\Facades\Gate;

class MercadogerenteController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        $estado = Estado::findOrFail($id);

        return view('admin.gerentes-mercado.index', compact('estado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Estado $estado)
    {
        return view('admin.gerentes-mercado.create', compact('estado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Estado $estado)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $estado->mercadogerentes()->create($validacion);

        return redirect()->route('admin.estados.gerentes-mercado.index', $estado->id)->with('success', 'Gerente de mercado creado satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mercadogerente $mercadogerente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mercadoGerente = Mercadogerente::findOrfail($id);

        return view('admin.gerentes-mercado.edit', compact('mercadoGerente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $mercadoGerente = Mercadogerente::findOrfail($id);

        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $mercadoGerente->update($validacion);

        return redirect()->route('admin.estados.gerentes-mercado.index', $mercadoGerente->estado_id)->with('success', 'Gerente de mercado editado satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $mercadoGerente = Mercadogerente::findOrfail($id);

        $estadoId = $mercadoGerente->estado_id;

        $mercadoGerente->delete();

        return redirect()->route('admin.estados.gerentes-mercado.index', $estadoId)
            ->with('success', 'Gerente de mercado eliminado satisfactoriamente!');
    }
}
