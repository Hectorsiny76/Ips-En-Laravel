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
    public $nombre = '';

    // Archivos
    public $archivoTipos = [];
    public $arrayArchivos = [];

    public function mount()
    {
        $this->archivoTipos = Archivotipo::all()->toArray();

        $this->agregarFilaArchivo();
    }

    public function agregarFilaArchivo()
    {
        $this->arrayArchivos[] = [
            'titulo' => '',
            'linkUrl' => '',
            'archivoSubido' => null,
            'archivotipo_id' => '',
        ];
    }

    public function eliminarFilaArchivo($index){
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

                    $reglas["arrayArchivos.{$index}.archivoSubido"] = [
                        'required',
                        'file',
                        function( string $atributo, $valor, \Closure $fallo) use ($extensiones) {
                            if($valor){
                                $extensionActual = strtolower($valor->getClientOriginalExtension());

                                if(!in_array($extensionActual, $extensiones)) {
                                    $fail("El archivo debe de ser un: " . implode(', ', $extensiones));
                                }
                            }
                        },
                        'max:'. $tipo['tam_max_kb']
                    ];
                }
            }
        }

        $this->validate($reglas);

        $estTipo = Establecimientotipo::create([
            'nombre' => $this->nombre
        ]);

        if(count($this->arrayArchivos) > 0){
            $guardadoService->guardarArchivosParaEsttipo($estTipo, $this->arrayArchivos);
        }

        return redirect()
            ->route('admin.establecimientotipo.index')
            ->with('success', 'Se ha creado el tipo de establecimiento y se han guardado los archivos!');

    }

};
?>

<x-livewire-parent-div>

    <x-form-errors/>

    <x-div-edit-create-title>Agregar un nuevo tipo de establecimiento</x-div-edit-create-title>

    <x-livewire-content-div>
        <form wire:submit="guardar" class="space-y-6" method="POST">
            @csrf
            <div class="mb-6">

                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Tienda"
                    wire:model="nombre"
                    required
                />

            </div>

            <div class="border p-4">
                <div class="flex dark:text-gray-300 justify-between items-center mb-4">
                    <h3>Archivos Relacionados</h3>

                    <button type="button" wire:click="agregarFilaArchivo" class="dark:text-gray-300 dark:bg-blue-900 dark:hover:text-gray-200 bg-blue-500 text-white px-3 py-1">
                        + Agregar Otra Fila
                    </button>

                </div>

                @foreach($arrayArchivos as $index => $archivoDatos)
                    <div wire:key="fila-archivo-{{$index}}" class="w-full grid grid-cols-[1fr_1fr_1fr_10%] border p-3 mb-3 gap-4 dark:bg-gray-800 bg-white">

                        <div class="p-2">
                            <x-input-form-label for="titulo">Titulo</x-input-form-label>

                            <x-input-form
                                placeholder="Escalacion a..."
                                type="text"
                                wire:model="arrayArchivos.{{$index}}.titulo"
                            />
                        </div>

                        <div class="p-2">
                            <x-input-form-label for="archivotipo_id">Tipo de Archivo</x-input-form-label>

                            <x-input-form-select initialvalue="-- Selecciona un tipo de archivo --" wire:model.live="arrayArchivos.{{$index}}.archivotipo_id" wire:key="select-{{$index}}">

                                @foreach($archivoTipos as $tipo)
                                    <option value="{{$tipo['id']}}" wire:key="opt-{{$index}}-{{$tipo['id']}}">
                                        {{$tipo['nombre']}}
                                    </option>
                                @endforeach

                            </x-input-form-select>
                        </div>

                        <div wire:key="inputs-condicionales-{{$index}}" class="p-2">
                            @php
                             $idTipoActual = $archivoDatos['archivotipo_id'];
                             $tipoSeleccionado = collect($archivoTipos)->firstWhere('id', '==', $idTipoActual);
                            @endphp

                            @if($tipoSeleccionado)
                                @if($tipoSeleccionado['es_link'])
                                    <x-input-form-label for="ruta">URL</x-input-form-label>
                                    <x-input-form
                                    type="url"
                                    placeholder="google.com"
                                    wire:model="arrayArchivos.{{$index}}.linkUrl"
                                    />
                                @else
                                    <x-input-form-label for="archivo">Subir un archivo</x-input-form-label>
                                    <x-input-form
                                    type="file"
                                    name="archivo"
                                    placeholder=""
                                    value=""
                                    wire:model="arrayArchivos.{{$index}}.archivoSubido"
                                    class="w-full"
                                    />
                                @endif
                            @else
                                <div class="text-center flex items-center justify-center border-2 border-dashed border-gray-700 rounded-md h-full flex-1">
                                    <h1 class="text-gray-600">Selecciona un tipo de archivo para poder agregarlo</h1>
                                </div>
                            @endif

                        </div>

                        <div class="p-2 flex items-center justify-center">
                            <button
                                type="button"
                                wire:click="eliminarFilaArchivo({{$index}})"
                                class="border text-xl dark:border-red-400 dark:text-red-800 dark:hover:bg-red-700 dark:hover:text-red-200 border-red-600 text-red-500 p-2"
                            >
                                Eliminar
                            </button>
                        </div>

                    </div>
                @endforeach

            </div>
            <x-form-create-buttons href="{{ route('admin.establecimientotipo.index') }}"/>
        </form>
    </x-livewire-content-div>


</x-livewire-parent-div>
