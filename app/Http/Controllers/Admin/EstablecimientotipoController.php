<?php

namespace App\Http\Controllers\Admin;

use App\Models\Establecimientotipo;
use Illuminate\Http\Request;

class EstablecimientotipoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estTipos = Establecimientotipo::all();

        $columnas = ['Nombre'];

        $columnasDb = ['nombre'];

        return view('admin.establecimientotipo.index', compact('estTipos', 'columnas', 'columnasDb'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.establecimientotipo.create');
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
    public function show($id)
    {
        $columnas = ['Nombre', 'Numero', 'Cajas/TPVS', 'Id de red', 'Gerente de Campo'];

        $columnasDb = ['nombre', 'numero', 'cajas_tpvs', 'idred', 'campogerente.nombre'];

        $estTipo = Establecimientotipo::findOrFail($id);

        $establecimientos = $estTipo->establecimientos()->with(['campogerente', 'tidelprograma', 'tiendaformato', 'avaloncontrato'])->get();

        if($estTipo->nombre == 'Tienda'){
            $columnas[] = 'Ip Tidel';
            $columnasDb[] = 'tidelprograma.ip';

            $columnas[] = 'Formato de Tienda';
            $columnasDb[] = 'tiendaformato.nombre';
        }
        else if($estTipo->nombre == 'Estacion'){
            $columnas[] = 'CDC';
            $columnasDb[] = 'centrodecostos';

            $columnas[] = 'Tel';
            $columnasDb[] = 'tel';

            $columnas[] = 'Correo';
            $columnasDb[] = 'correo';

            $columnas[] = 'Contrato Ávalon';
            $columnasDb[] = 'avaloncontrato.numero';
        }

        return view('admin.establecimientotipo.show', compact('estTipo','establecimientos', 'columnas', 'columnasDb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Establecimientotipo $establecimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Establecimientotipo $establecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Establecimientotipo $establecimiento)
    {
        //
    }
}
