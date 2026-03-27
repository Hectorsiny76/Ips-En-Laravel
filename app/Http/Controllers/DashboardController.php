<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Establecimientotipo;

class DashboardController extends Controller
{
    public function index(){
        $establecimientos = Establecimiento::all();

        $tiendas = Establecimientotipo::withCount('tiendas')->get();

        return view('layout.dashboard', compact('establecimientos'));
    }
}
