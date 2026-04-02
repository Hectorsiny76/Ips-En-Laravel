<?php

namespace App\Http\Controllers;

use App\Models\Mercadogerente;
use Illuminate\Http\Request;
use App\Models\Estado;

class MercadogerenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Estado $estado)
    {

        $columnas = ['nombre'];

        $columnasDb = ['nombre'];

        $mercadoGerentes = $estado->mercadoGerentes;

        return view('gerentes-mercado.index', compact('estado', 'mercadoGerentes', 'columnas', 'columnasDb'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Estado $estado)
    {
        return view('gerentes-mercado.create', compact('estado'));
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

        return redirect()->route('estados.gerentes-mercado.index', $estado->id)->with('success', 'Gerente de mercado creado satisfactoriamente!');
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

        return view('gerentes-mercado.edit', compact('mercadoGerente'));
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

        return redirect()->route('estados.gerentes-mercado.index', $mercadoGerente->estado_id)->with('success', 'Gerente de mercado editado satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mercadoGerente = Mercadogerente::findOrfail($id);

        $estadoId = $mercadoGerente->estado_id;

        if ($mercadoGerente->mercado()->count() > 0) {
            // No permite que sea eliminado pues está ligado a un mercado
            return redirect()->route('estados.gerentes-mercado.index', $estadoId)
                ->with('error', 'No puedes eliminar este gerente de mercado debido a que tiene un mercado asignado. Favor de reasignar el mercado a otro gerente.');
        }

        $mercadoGerente->delete();

        return redirect()->route('estados.gerentes-mercado.index', $estadoId)
            ->with('success', 'Gerente de mercado eliminado satisfactoriamente!');
    }
}
