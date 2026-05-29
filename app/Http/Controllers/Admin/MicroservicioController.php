<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Microservicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MicroservicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.microservicios.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.microservicios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $microservicio = Microservicio::create($validacion);

        return redirect()->route('admin.microservicios.index')->with('success', 'Microservicio  '.$microservicio->nombre.' creado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Microservicio $microservicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $microservicio = Microservicio::findOrFail($id);

        return view('admin.microservicios.edit', compact('microservicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $microservicio = Microservicio::findOrFail($id);

        $validacion = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $microservicio->update($validacion);

        return redirect()->route('admin.microservicios.index')->with('success', 'Microservicio '.$microservicio->nombre.' actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::authorize('delete-data-create-users');

        $microservicio = Microservicio::findOrFail($id);

        $microservicioEliminado = $microservicio;

        $microservicio->delete();

        return redirect()->route('admin.servicios.index')->with('success', 'El microservicio '.$microservicioEliminado->nombre.' fue eliminado correctamente!');
    }
}
