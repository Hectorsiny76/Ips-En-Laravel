<?php

namespace App\Http\Controllers\Admin;

use App\Models\Archivotipo;
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

        $estTipo->load(['establecimientos.avaloncontrato', 'establecimientos.campogerente', 'establecimientos.cluster', 'establecimientos.tidelprograma', 'establecimientos.tiendaformato']);

        $establecimientos = $estTipo->establecimientos;

        if($estTipo->nombre == 'Tienda'){
            $columnas[] = 'Ip Tidel';
            $columnasDb[] = 'tidelprograma.ip';

            $columnas[] = 'Formato de Tienda';
            $columnasDb[] = 'tiendaformato.nombre';

            $columnas[] = 'Cluster';
            $columnasDb[] = 'cluster.nombre';
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
    public function edit($id)
    {
        $estTipo = Establecimientotipo::findOrFail($id);

        return view('admin.establecimientotipo.edit', compact('estTipo'));
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
