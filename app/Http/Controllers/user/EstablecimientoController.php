<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Establecimiento;
use App\Services\SucursalService;

class EstablecimientoController extends Controller
{
    public function __construct(private SucursalService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.main.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $est = Establecimiento::findOrFail($id);

        return view('user.main.show', compact('est'));
    }
}
