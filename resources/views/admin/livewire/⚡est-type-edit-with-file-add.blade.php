<?php

use Livewire\Component;
use App\Models\Archivotipo;
use App\Models\Establecimientotipo;
use Livewire\WithFileUploads;
use App\Services\GuardadoDeArchivosService;

new class extends Component
{
    use WithFileUploads;

    // EstablecimientoTipo
    public Establecimientotipo $estTipo;
    public $nombre = '';

    // Archivos
    public $archivoTipos = [];
    public $arrayArchivos = [];

    public $archivosAEliminar = [];

    public function mount(Establecimientotipo $estTipo)
    {

        $this->estTipo = $estTipo;

        $this->nombre = $estTipo->nombre;

        $this->archivoTipos = Archivotipo::all()->toArray();

        foreach ($estTipo->archivos as $archivo){
            $es_link = collect($this->archivoTipos)->firstWhere('id', '==', $archivo->archivotipo_id)['es_link'] ?? false;

            $this->arrayArchivos[] = [
                'archivo_id' => $archivo->id,
                'archivotipo_id' => $archivo->archivotipo_id,
                'titulo' => $archivo->titulo,
                'linkUrl' => $es_link ? $archivo->ruta : '',
                'archivoSubido' => null,
                'ruta_existente' => !$es_link ? $archivo->ruta : null,
            ];
        }
    }

    public function agregarFilaArchivo()
    {
        $this->arrayArchivos[] = [
            'archivo_id' => null,
            'titulo' => '',
            'linkUrl' => '',
            'archivoSubido' => null,
            'archivotipo_id' => '',
            'ruta_existente' => null,
        ];
    }

    public function eliminarFilaArchivo($index){

        if(!empty($this->arrayArchivos[$index]['archivo_id'])) {
            $this->archivosAEliminar[] = $this->arrayArchivos[$index]['archivo_id'];
        }

        unset($this->arrayArchivos[$index]);
        $this->arrayArchivos = array_values($this->arrayArchivos);
    }

    public function guardar(GuardadoDeArchivosService $guardadoService)
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'arrayArchivos.*.titulo' => 'required|string|max:255',
            'arrayArchivos.*.archivotipo_id' => 'required|exists:archivotipos,id'
        ]);

        foreach ($this->arrayArchivos as $index => $archivoDatos){
            if(empty($archivoDatos['archivotipo_id'])){
                continue;
            }

            $tipo = collect($this->archivoTipos)->firstWhere('id', '==', $archivoDatos['archivotipo_id']);

            if($tipo){
                if($tipo['es_link']){
                    $reglas["arrayArchivos.{$index}.linkUrl"] = 'required|url|max:2048';
                } else {

                    $archivoString = str_replace('  ', ' ', $tipo['mimes_permitidos']);

                    $extensiones = explode(',', strtolower($archivoString));

                    $esRequerido = empty($archivoDatos['archivo_id'] ? 'required' : 'nullable');


                    $reglas['arrayArchivos.{$index}.archivoSubido'] = [
                        $esRequerido,
                        'file',
                        function( string $atributo, $valor, \Closure $fallo) use ($extensiones) {
                            if($valor){
                                $extensionActual = strtolower($valor->getClientOriginalExtension());

                                if(!in_array($extensionActual, $extensiones)) {
                                    $fail("El archivo debe de ser un: " . implode(', ', $extensiones));
                                }
                            }
                        },
                        'max:' . $tipo['tam_max_kb'],
                    ];
                }
            }
        }

        $this->validate($reglas);

        if(count($this->arrayArchivos) > 0){
            $guardadoService->actualizarArchivosParaEsttipo($this->estTipo, $this->arrayArchivos, $this->archivosAEliminar);
        }

        return redirect()
            ->route('admin.establecimientotipo.index')
            ->with('success', 'Se han actualizado y guardado los archivos!');

    }

};
?>

<div class="w-full overflow-auto">

    <x-form-errors/>

    <x-div-edit-create-title>Actualizar archivos del establecimiento {{$estTipo->nombre}}</x-div-edit-create-title>

    <div class="flex-1 bg-white shadow rounded-lg p-3">
        <form wire:submit="guardar" class="space-y-6" method="POST">
            @csrf
            <div class="mb-6">

                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <input
                    type="text"
                    name="nombre"
                    value="{{old('nombre', $estTipo->nombre)}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700
                    @error('nombre') border-red-500 text-red-900 @else border-gray-300  @enderror"
                    wire:model="nombre"
                    readonly>

            </div>

            <div class="border p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3>Archivos Relacionados</h3>

                    <button type="button" wire:click="agregarFilaArchivo" class="bg-blue-500 text-white px-3 py-1">
                        + Agregar Otra Fila
                    </button>

                </div>

                @foreach($arrayArchivos as $index => $archivoDatos)
                    <div wire:key="fila-archivo-{{$index}}" class="w-full border p-3 mb-3 grid grid-cols-[1fr_1fr_1fr_10%] gap-4 bg-white">

                        <div class="p-2">
                            <x-input-form-label for="titulo">Titulo</x-input-form-label>

                            <input
                                placeholder="Escalacion a..."
                                type="text"
                                wire:model="arrayArchivos.{{$index}}.titulo"
                                class="w-full"
                            />
                        </div>

                        <div class="p-2">
                            <x-input-form-label for="archivotipo_id">Tipo de Archivo</x-input-form-label>

                            <select wire:model.live="arrayArchivos.{{$index}}.archivotipo_id" wire:key="select-{{$index}}" class="w-full">
                                <option value="">Selecciona un Tipo de Archivo</option>

                                @foreach($archivoTipos as $tipo)
                                    <option value="{{$tipo['id']}}" wire:key="opt-{{$index}}-{{$tipo['id']}}">
                                        {{$tipo['nombre']}}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div wire:key="inputs-condicionales-{{$index}}" class="p-2">
                            @php
                                $idTipoActual = $archivoDatos['archivotipo_id'];
                                $tipoSeleccionado = collect($archivoTipos)->firstWhere('id', '==', $idTipoActual);
                            @endphp

                            @if($tipoSeleccionado)
                                @if($tipoSeleccionado['es_link'])
                                    <x-input-form-label for="ruta">URL</x-input-form-label>
                                    <input
                                        type="url"
                                        placeholder="google.com"
                                        wire:model="arrayArchivos.{{$index}}.linkUrl"
                                        class="w-full"
                                    />
                                @else
                                    @if($archivoDatos['ruta_existente'])

                                        <div class="text-sm text-gray-600 mb-2">
                                            ✅ Archivo Guardado.
                                        </div>

                                        <x-input-form-label for="archivo">Subir un archivo (Reemplaza al anterior)</x-input-form-label>
                                        <x-input-form
                                            type="file"
                                            name="archivo"
                                            placeholder=""
                                            value=""
                                            wire:model="arrayArchivos.{{$index}}.archivoSubido"
                                            wire:key="archivo-{{$index}}"
                                            class="w-full"
                                        />
                                    @else
                                        <x-input-form-label for="archivo">Subir un archivo</x-input-form-label>
                                        <x-input-form
                                            type="file"
                                            name="archivo"
                                            placeholder=""
                                            value=""
                                            wire:model="arrayArchivos.{{$index}}.archivoSubido"
                                            wire:key="archivo-{{$index}}"
                                            class="w-full"
                                        />
                                    @endif
                                @endif
                            @else
                                <div class="text-center flex justify-center items-center border-2 border-dashed border-gray-700 rounded-md h-full flex-1">
                                    <h1 class="text-gray-600">Selecciona un tipo de archivo para poder agregarlo</h1>
                                </div>
                            @endif

                        </div>

                        <div class="text-center flex items-center justify-center p-2">
                            <button
                                type="button"
                                wire:click="eliminarFilaArchivo({{$index}})"
                                class="border text-xl border-red-600 text-red-500 p-2"
                            >
                                Eliminar
                            </button>
                        </div>

                    </div>
                @endforeach

            </div>
            <x-form-update-buttons href="{{ route('admin.establecimientotipo.index') }}"/>
        </form>
    </div>


</div>
