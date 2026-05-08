<?php

namespace App\Services;

use App\Models\Establecimiento;
use App\Http\Requests\BuscarSucursalRequest;

class SucursalService
{
    /**
     * Busca una sucursal filtrando por nombre, número y/o centro de costos.
     */
    public function buscar(BuscarSucursalRequest $request): ?Establecimiento
    {
        return Establecimiento::with([
            'campogerente',
            'tiendaformato',
            'tidelprograma',
            'estado',
            'mercadogerente',
            'mercado',
            'campo',
            'establecimientotipo'
        ])
            ->when(
                $request->nombre,
                fn($q) =>
                $q->where('nombre', 'like', '%' . $request->nombre . '%')
            )
            ->when(
                $request->centrodecostos,
                fn($q) =>
                $q->where('centrodecostos', 'like', '%' . $request->centrodecostos . '%')
            )
            ->when(
                $request->numero,
                fn($q) =>
                $q->where('numero', $request->numero)
            )
            ->orWhere('centrodecostos', $request->centrodecostos)
            ->first();
    }

    /**
     * Devuelve la configuración de columnas según el tipo de sucursal.
     */
    public function columnas(Establecimiento $est): array
    {
        $tipo = optional($est->establecimientotipo)->nombre;

        return match (true) {
            str_contains(strtolower($tipo), 'estacion') => [
                ['key' => 'numero', 'label' => 'Número'],
                ['key' => 'nombre', 'label' => 'Nombre'],
                ['key' => 'idred', 'label' => 'IP'],
                ['key' => 'centrodecostos', 'label' => 'Centro de Costos'],
            ],
            default => [ // tienda u otro
                ['key' => 'numero', 'label' => 'Número'],
                ['key' => 'nombre', 'label' => 'Nombre'],
                ['key' => 'idred', 'label' => 'IP'],
            ],
        };
    }
}
