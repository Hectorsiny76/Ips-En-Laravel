<?php

namespace App\Http\Controllers;

use App\Models\Mercado;
use Illuminate\Http\Request;
use App\Models\Mercadogerente;

class MercadoController extends Controller
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
            return redirect()->route('estados.gerentes-mercado.index', $mercadoGerente->estado_id)
                ->with('error', 'Este gerente de mercado no tiene ningún mercado a su nombre.');
        }

        return view('mercados.index', compact('mercado','mercadoGerente', 'columnas', 'columnasDb'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mercado $mercado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mercado $mercado)
    {
        //
    }
}
