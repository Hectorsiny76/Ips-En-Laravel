<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuscarSucursalRequest;
use App\Services\SucursalService;

class EstablecimientoController extends Controller
{
    public function __construct(private SucursalService $service) {}

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
    public function show(BuscarSucursalRequest $request)
    {
        $est = $this->service->buscar($request);
        $columnas = $est ? $this->service->columnas($est) : [];

        return view('user.main.show', compact('est', 'columnas'));
    }
}
