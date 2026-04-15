<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mercado;
use Illuminate\Http\Request;
use App\Models\Mercadogerente;
use App\Models\Establecimientotipo;

class MercadoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $mercadoGerente = Mercadogerente::with('mercado.establecimientotipo')->findOrFail($id);

        $columnas = ['Número de mercado', 'Gerente de Mercado', 'Tipo de establecimiento'];

        $columnasDb = ['numero', 'mercadogerente.nombre', 'establecimientotipo.nombre'];

        $mercado = $mercadoGerente->mercado;

        if ($mercadoGerente->mercado()->count() == 0) {
            // No permite que sea eliminado pues está ligado a un mercado
            return redirect()->route('gerentes-mercado.mercados.create', $mercadoGerente->id)
                ->with('error', 'Este gerente de mercado no tiene ningún mercado a su nombre. Agregue uno.');
        }

        return view('admin.mercados.index', compact('mercado','mercadoGerente', 'columnas', 'columnasDb'));

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
            'numero' => 'required|string|min:1|max:10',
            'establecimientotipo_id' => 'required|integer',
        ]);

        $mercadoGerente = Mercadogerente::findOrFail($id);

        $mercadoGerente->mercado()->create($validacion);

        $mercado = $mercadoGerente->load('mercado');

        return redirect()->route('gerentes-mercado.mercados.index', $mercado->id)->with('success', 'Mercado creado correctamente');
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
    public function update(Request $request, Mercado $mercado)
    {
        $validacion = $request->validate([
            'numero' => 'required|string|min:1|max:10',
            'establecimientotipo_id' => 'required|integer',
        ]);

        $mercado->update($validacion);

        return redirect()->route('admin.gerentes-mercado.mercados.index', $mercado->id)->with('success', 'Mercado actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mercado $mercado)
    {
        //
    }
}
