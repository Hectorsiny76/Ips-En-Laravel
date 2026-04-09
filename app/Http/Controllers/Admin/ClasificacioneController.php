<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clasificacione;
use Illuminate\Http\Request;

class ClasificacioneController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clasificaciones = Clasificacione::with(['categoria', 'subcategoria', 'servicio', 'microservicio'])->get();

        return view('clasificaciones', compact('clasificaciones'));
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
    public function show(Clasificacione $clasificacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clasificacione $clasificacione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clasificacione $clasificacione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clasificacione $clasificacione)
    {
        //
    }
}
