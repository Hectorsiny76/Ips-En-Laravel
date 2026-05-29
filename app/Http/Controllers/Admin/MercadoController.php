<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mercado;
use Illuminate\Http\Request;
use App\Models\Mercadogerente;
use App\Models\Establecimientotipo;
use Illuminate\Support\Facades\Gate;

class MercadoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $mercadoGerente = Mercadogerente::findOrFail($id);

        if ($mercadoGerente->mercado()->count() == 0) {
            // No se puede ver el mercado, pues el gerente de mercado no tiene niguno asignado, por lo cual se le redirige a la página de creación de mercado
            return redirect()->route('admin.gerentes-mercado.mercados.create', $mercadoGerente->id)
                ->with('error', 'Este gerente de mercado no tiene ningún mercado a su nombre. Agregue uno.');
        }

        $mercadoGerente->load('mercado');

        $mercado = $mercadoGerente->mercado;

        $mercado->loadCount('encargados');

        return view('admin.mercados.index', compact('mercado','mercadoGerente'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $mercadoGerente = Mercadogerente::findOrFail($id);

        $estTipos = Establecimientotipo::all();

        return view('admin.mercados.create', compact('mercadoGerente', 'estTipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $validacion = $request->validate([
            'numero' => 'required|string|min:1|max:10|unique:mercados,numero',
            'establecimientotipo_id' => 'required|integer',
            'asociados.*' => 'nullable|integer|exists:asociados,id',
        ],['numero.unique' => 'Este número de mercado ya está registrado.']);

        $mercadoGerente = Mercadogerente::findOrFail($id);

        $mercadoGerente->mercado()->create($validacion);

        $mercadoGerente->load('mercado');

        $mercado = $mercadoGerente->mercado;

        $mercado->encargados()->sync($request->input('asociados', []));

        return redirect()->route('admin.gerentes-mercado.mercados.index', $mercado->id)->with('success', 'Mercado creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mercado $mercado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mercado $mercado)
    {
        $estTipos = Establecimientotipo::all();

        return view('admin.mercados.edit', compact('mercado', 'estTipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $mercado = Mercado::findOrFail($id);

        $request->validate([
            'numero' => 'required|string|min:1|max:10|unique:mercados,numero,'.$mercado->id,
            'establecimientotipo_id' => 'required|integer',
            'asociados.*' => 'nullable|integer|exists:asociados,id',
        ],['numero.unique' => 'Este número de mercado ya está registrado.']);

        $mercado->update([
            'numero' => $request->input('numero'),
            'establecimientotipo_id' => $request->input('establecimientotipo_id'),
        ]);

        $mercado->encargados()->sync($request->input('asociados', []));

        return redirect()->route('admin.gerentes-mercado.mercados.index', $mercado->mercadogerente->id)->with('success', 'Mercado actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $mercado = Mercado::findOrFail($id);

        $mercadoEliminado = $mercado;

        $mercado->delete();

        return redirect()->route('admin.gerentes-mercado.mercados.index', $mercadoEliminado->mercadogerente->id)->with('success', 'Mercado '.$mercadoEliminado->numero.' eliminado correctamente');
    }
}
