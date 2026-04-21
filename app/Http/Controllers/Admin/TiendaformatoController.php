<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiendaformato;
use Illuminate\Http\Request;

class TiendaformatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiendaformatos = Tiendaformato::withCount('establecimientos')->get();

        return view('admin.tienda-formatos.index', compact('tiendaformatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.tienda-formatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
           'nombre' => 'required|string|max:50|unique:tiendaformatos,nombre',
        ],['nombre.unique'=>'El nombre ya existe']);

        Tiendaformato::create($validacion);

        return redirect()->route('admin.tienda-formatos.index')->with('success','Formato de tienda creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tiendaformato $tiendaformato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tiendaformato = Tiendaformato::findOrFail($id);

        return view('admin.tienda-formatos.edit', compact('tiendaformato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tiendaformato = Tiendaformato::findOrFail($id);

        $validacion = $request->validate([
            'nombre' => 'required|string|max:50|unique:tiendaformatos,nombre,'.$tiendaformato->id,
        ],['nombre.unique'=>'El nombre ya existe']);

        $tiendaformato->update($validacion);

        return redirect()->route('admin.tienda-formatos.index')->with('success','Formato de tienda actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tiendaformato = Tiendaformato::findOrFail($id);

        if($tiendaformato->establecimientos()->count() > 0){
            return redirect()->route('admin.tienda-formatos.index')->with('error', 'No se puede eliminar este formato de tienda ya que tiene establecimientos asociados');
        }

        $tiendaformato->delete();

        return redirect()->route('admin.tienda-formatos.index')->with('success','Formato de tienda eliminado satisfactoriamente');
    }
}
