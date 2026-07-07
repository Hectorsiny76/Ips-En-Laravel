<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Establecimiento;
use App\Services\SucursalService;

class EstablecimientoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.main.index');
    }

}
