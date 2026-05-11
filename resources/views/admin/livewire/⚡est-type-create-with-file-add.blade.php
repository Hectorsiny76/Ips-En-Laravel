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

                    $extensiones = str_replace('  ', ' ', $tipo['mimes_permitidos']);

                    $reglas["arrayArchivos.{$index}.archivoSubido"] = [
                        'required',
                        'file',
                        'extensions:' . $extensiones,
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

<div class="w-full">

    <x-form-errors/>

    <x-div-edit-create-title>Agregar un nuevo tipo de establecimiento</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <form wire:submit="guardar" class="space-y-6" method="POST">
            @csrf
            <div class="mb-6">

                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <input
                    type="text"
                    name="nombre"
                    placeholder="Tienda"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700
                    @error('nombre') border-red-500 text-red-900 @else border-gray-300  @enderror"
                    wire:model="nombre"
                    required>

                @error('nombre')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                @enderror

            </div>

            <div class="border p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3>Archivos Relacionados</h3>

                    <button type="button" wire:click="agregarFilaArchivo" class="bg-blue-500 text-white px-3 py-1">
                        + Agregar Otra Fila
                    </button>

                </div>

                @foreach($arrayArchivos as $index => $archivoDatos)
                    <div wire:key="fila-archivo-{{$index}}" class="w-full border p-3 mb-3 flex gap-4 items-start bg-white">

                        <div>
                            <x-input-form-label for="titulo">Titulo</x-input-form-label>

                            <input
                                placeholder="Escalacion a..."
                                type="text"
                                wire:model="arrayArchivos.{{$index}}.titulo"
                            />
                        </div>

                        <div>
                            <x-input-form-label for="archivotipo_id">Tipo de Archivo</x-input-form-label>

                            <select wire:model.live="arrayArchivos.{{$index}}.archivotipo_id" wire:key="select-{{$index}}">
                                <option value="">Selecciona un Tipo de Archivo</option>

                                @foreach($archivoTipos as $tipo)
                                    <option value="{{$tipo['id']}}" wire:key="opt-{{$index}}-{{$tipo['id']}}">
                                        {{$tipo['nombre']}}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div wire:key="inputs-condicionales-{{$index}}">
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
                                    />
                                @else
                                    <x-input-form-label for="archivo">Subir un archivo</x-input-form-label>
                                    <x-input-form
                                    type="file"
                                    name="archivo"
                                    placeholder=""
                                    value=""
                                    wire:model="arrayArchivos.{{$index}}.archivoSubido"
                                    />
                                @endif
                            @endif

                        </div>

                        <div>
                            <button
                                type="button"
                                wire:click="eliminarFilaArchivo({{$index}})"
                                class="border border-red-600 text-red-500 mt-8 p-2"
                            >
                                Eliminar
                            </button>
                        </div>

                    </div>
                @endforeach

            </div>
            <x-form-create-buttons href="{{ route('admin.establecimientotipo.index') }}"/>
        </form>
    </div>


</div>
