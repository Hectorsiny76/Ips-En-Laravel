<?php

namespace App\Services;

use App\Models\Archivo;
use App\Models\Establecimientotipo;
use Illuminate\Support\Facades\Storage;

class GuardadoDeArchivosService
{
    /**
    * Este servicio se encarga de guardar los archivos dependiendo de la función a llamar
    */
    public function guardarArchivosParaEsttipo(Establecimientotipo $estTipo, array $archivoDatos)
    {
        $archivoIds = [];

        foreach ($archivoDatos as $datos) {
            $path = null;

            // 1. Buscar si se trata de un archivo físico o un link
            if (isset($datos['archivoSubido']) && $datos['archivoSubido']) {
                // Si es un archivo físico se guarda en el disco local
                $path = $datos['archivoSubido']->store('archivos_esttipo', 'local');
            } else {
                // Si es un link se guarda su URL
                $path = $datos['linkUrl'];
            }

            // 2. Una vez se tienen los datos, se guardan creando los objetos de cada archivo guardado respectivamente
            $archivo = Archivo::create([
            'archivotipo_id' => $datos['archivotipo_id'],
            'titulo'        => $datos['titulo'],
            'ruta'    => $path,
            ]);

            // Una vez se crea el objeto se guarda su id en el array
            $archivoIds[] = $archivo->id;
        }

        // 3. Todos los ids obtenidos y guardados en $archivoIds se mandan a la tabla de unión archivos_esttipos
        // Se utiliza el metodo syncWithoutDetaching para no borrar los archivos previamente guardados
        $estTipo->archivos()->syncWithoutDetaching($archivoIds);
    }

    public function actualizarArchivosParaEsttipo(Establecimientotipo $estTipo, array $archivoDatos, array $archivosParaEliminar)
    {
        if(!empty($archivosParaEliminar)) {
            $archivosParaEliminar =  Archivo::whereIn('id', $archivosParaEliminar)->get();

            foreach ($archivosParaEliminar as $archivo) {
                if(!$archivo->archivotipo->es_link) {
                    Storage::disk('local')->delete($archivo->ruta);
                }
                $archivo->delete();
            }
        }

        $archivoIds = [];

        foreach ($archivoDatos as $datos) {

            if(empty($datos['archivo_id'])){
                $ruta = null;

                if(isset($datos['archivoSubido']) && $datos['archivoSubido']) {
                    $ruta = $datos['archivoSubido']->store('archivos_esttipo', 'local');
                } else {
                    $ruta = $datos['linkUrl'];
                }

                $archivoNuevo = Archivo::create([
                    'titulo'        => $datos['titulo'],
                    'ruta'    => $ruta,
                    'archivotipo_id' => $datos['archivotipo_id'],
                ]);

                $archivoIds[] = $archivoNuevo->id;
            }

            else {
                $archivoExistente = Archivo::findOrFail($datos['archivo_id']);

                $archivoExistente->titulo = $datos['titulo'];

                if(isset($datos['archivoSubido']) && $datos['archivoSubido']) {
                    Storage::disk('local')->delete($archivoExistente->ruta);

                    $archivoExistente->ruta = $datos['archivoSubido'];
                } elseif(isset($datos['linkUrl']) && $datos['linkUrl'] !== '') {
                    $archivoExistente->ruta = $datos['linkUrl'];
                }

                $archivoExistente->save();

                $archivosIds[] = $archivoExistente->id;

            }
        }

        $estTipo->archivos()->syncWithoutDetaching($archivoIds);
    }
}
