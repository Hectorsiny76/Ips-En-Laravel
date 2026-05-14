<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.servicios.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $servicio = Servicio::create($validacion);

        return redirect()->route('admin.servicios.index')->with('success', 'El servicio '.$servicio->nombre.' fue guardado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);

        return view('admin.servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $servicio->update($validacion);

        return redirect()->route('admin.servicios.index')->with('success', 'El servicio '.$servicio->nombre.' fue actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);

        if($servicio->clasificaciones()->count() > 0){
            return redirect()
                ->route('admin.servicios.index')
                ->with('error', 'No se puede eliminar este servicio porque tiene clasificaciones asignadas!');
        }

        $servicioEliminado = $servicio;

        $servicio->delete();

        return redirect()->route('admin.servicios.index')->with('success', 'El servicio '.$servicioEliminado->nombre.' fue eliminado correctamente!');
    }
}
