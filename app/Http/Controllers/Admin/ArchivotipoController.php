<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Archivotipo;
use Illuminate\Http\Request;

class ArchivotipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $archivotipos = Archivotipo::all();

        return view('admin.archivo-tipos.index', compact('archivotipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.archivo-tipos.create');
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
    public function show(Archivotipo $archivotipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archivotipo $archivotipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archivotipo $archivotipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archivotipo $archivotipo)
    {
        //
    }
}
