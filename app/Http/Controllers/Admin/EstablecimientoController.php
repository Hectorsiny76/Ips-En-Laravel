<?php

namespace App\Http\Controllers\Admin;

use App\Models\Avaloncontrato;
use App\Models\Estatus;
use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Mercadogerente;
use App\Models\Establecimientotipo;
use App\Models\Mercado;
use App\Models\Campo;
use App\Models\Campogerente;
use App\Models\Tidelprograma;
use App\Models\Tiendaformato;
use App\Models\Establecimiento;
use Illuminate\Support\Str;

class EstablecimientoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $campogerente = Campogerente::findOrFail($id);

        $campogerente->load(['establecimientotipo', 'establecimientos'])->get();

        $columnas = ['Nombre', 'Numero', 'Cajas/TPVS', 'IP'];

        $columnasDb = ['nombre', 'numero', 'cajas_tpvs', 'idred'];

        $estTipo = $campogerente->establecimientotipo;

        $establecimientos = $campogerente->establecimientos;

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

        return view('admin.establecimientos.index', compact('campogerente','estTipo','establecimientos', 'columnas', 'columnasDb'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $campogerente = Campogerente::findOrFail($id);

        $campogerente->load(['establecimientotipo'])->get();

        $estTipo = $campogerente->establecimientotipo;

        $tiendaformatos = Tiendaformato::all();

        $tidelprogramas = Tidelprograma::doesntHave('establecimiento')->pluck('ip', 'id');

        $estTipoNombre = Str::slug($estTipo->nombre);

        return view('admin.establecimientos.create', compact('campogerente', 'estTipo', 'estTipoNombre', 'tiendaformatos', 'tidelprogramas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $campogerente = Campogerente::findOrFail($id);

        $campogerente->load(['establecimientotipo'])->get();

        $estTipo = $campogerente->establecimientotipo;

        $estTipoNombre = Str::slug($estTipo->nombre);

        $validacionesBase = [
            'nombre' => 'required|string|max:255',
            'numero' => 'required|string|min:1|max:10',
            'cajas_tpvs' => 'required|numeric|min:1',
            'idred' => 'required|ip',
        ];

        $validacionesXEstablecimiento = [
            'tienda' => [
                'tiendaformato_id' => 'required|numeric|exists:tiendaformatos,id',
                'tidelprograma_id' => 'required|numeric|exists:tidelprogramas,id',
            ],
            'estacion' => [
                'centrodecostos' => 'required|numeric|min:1|unique:establecimientos,centrodecostos',
                'tel' => 'required|min:10|max:15',
                'correo' => 'required|string|email',
            ]
        ];

        $validacionFinal = array_merge($validacionesBase, $validacionesXEstablecimiento[$estTipoNombre] ?? []);

        $validacion = $request->validate($validacionFinal);

        $campogerente->establecimientos()->create($validacion);

        return redirect()->route('admin.campo-gerente.establecimientos.index', $campogerente->id)->with('success', 'El establecimiento para el campo '.$campogerente->campo->numero.' se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
