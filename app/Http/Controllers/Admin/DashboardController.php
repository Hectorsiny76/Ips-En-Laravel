<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Establecimientotipo;
use App\Models\Pilotoprograma;
use App\Models\Pilotoestablecimiento;

class DashboardController extends AdminController
{
    public function index(){
        $establecimientos = Establecimiento::count();
        $establecimientoTipos = Establecimientotipo::withCount('establecimientos')->get();
        $programasPiloto = Pilotoprograma::count();
        $pilotoEstablecimientos = Pilotoestablecimiento::count();

        return view('admin_layout.dashboard', compact('establecimientos', 'establecimientoTipos', 'programasPiloto', 'pilotoEstablecimientos'));
    }
}
