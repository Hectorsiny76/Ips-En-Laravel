<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cajatipo;
use Illuminate\Http\Request;

class CajatipoController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cajatipos = Cajatipo::withCount('establecimientos')->get();

        return view('admin.caja-tipos.index', compact('cajatipos'));
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
    public function show(Cajatipo $cajatipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cajatipo $cajatipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cajatipo $cajatipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cajatipo $cajatipo)
    {
        //
    }
}
