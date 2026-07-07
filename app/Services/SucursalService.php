<?php

namespace App\Services;

use App\Models\Establecimientotipo;
use Illuminate\Support\Str;

class SucursalService
{

    public static string $tiendaString = 'tienda';
    public static string $estacionString = 'estacion';

    /**
     * Función de apoyo para cambiar un string a tipo slug (Ej. tienda, tiendas-de-empeño, esto para mantener el orden y poder manejar los ifs)
     */
    public static function slug(string $value): string {
        return Str::slug($value);
    }

    /**
     * Arregla las columnas de las páginas de admin
     */
    public static function columnasAdmin(Establecimientotipo $estTipo) : array
    {
        $estTipoNombre = self::slug($estTipo->nombre);

        $columnas['th'] = ['Nombre', 'Numero', 'Cajas/TPVS', 'Id de red', 'Gerente de Campo'];

        $columnas['tb'] = ['nombre', 'numero', 'cajas_tpvs', 'idred', 'campogerente.nombre'];

        if($estTipoNombre == self::$tiendaString) {
            array_push($columnas['th'],'Ip Tidel', 'Formato de Tienda', 'Cluster');

            array_push($columnas['tb'],'tidelprograma.ip', 'tiendaformato.nombre', 'cluster.nombre');

        }
        else if($estTipoNombre == self::$estacionString){
            array_push($columnas['th'],'CDC', 'Tel', 'Correo', 'Contrato Ávalon');

            array_push($columnas['tb'], 'centrodecostos', 'tel', 'correo', 'avaloncontrato.numero');
        }

        return $columnas;
    }


    /**
     * Arregla las columnas para la validación de la creación de un establecimiento
     */
    public static function validacion(EstablecimientoTipo $estTipo, int $id = null) : array
    {
        $estTipoNombre = self::slug($estTipo->nombre);

        $validacionesBase = [
            'nombre' => 'required|string|max:255',
            'numero' => 'required|string|min:1|max:10',
            'cajas_tpvs' => 'required|numeric|min:1',
            'idred' => 'required|ip',
        ];

        if( $estTipoNombre == self::$tiendaString) {
            $validacionesXEstablecimiento = [
                'tienda' => [
                    'tiendaformato_id' => 'required|numeric|exists:tiendaformatos,id',
                    'tidelprograma_id' => 'required|numeric|exists:tidelprogramas,id',
                    'cluster_id' => 'required|numeric|exists:clusters,id',
                ]
            ];

        }
        else if($estTipoNombre == self::$estacionString){
            $validacionesXEstablecimiento = [
                'estacion' => [
                    'centrodecostos' => 'required|numeric|min:1|unique:establecimientos,centrodecostos,'.$id,
                    'tel' => 'required|min:10|max:15',
                    'correo' => 'required|string|email',
                ]
            ];
        }

        return array_merge($validacionesBase, $validacionesXEstablecimiento[$estTipoNombre] ?? []);
    }
}
