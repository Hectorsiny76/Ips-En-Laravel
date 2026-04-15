<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campo;
use Illuminate\Http\Request;
use App\Models\Mercado;

class CampoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $mercado = Mercado::find($id);

        $mercado->load('campos.campogerente');

        $campos = $mercado->campos;

        return view('admin.campos.index', compact('campos', 'mercado'));
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
    public function show(Campo $campo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campo $campo)
    {
        return view('admin.campos.edit', compact('campo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campo $campo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campo $campo)
    {
        //
    }
}
