<?php

use Livewire\Component;
use App\Models\Asociado;

new class extends Component
{
    public $search = '';
    public $results = [];

    public $selectedManagers = [];

    public function mount($mercado = null)
    {
        if($mercado){
            $mercado->load('encargados.area');

            $asociados = $mercado->encargados;

            foreach ($asociados as $asociado){
                $this->selectedManagers[$asociado->id] = [
                    'nombre' => $asociado->nombre,
                    'area' => $asociado->area->nombre,
                ];
            }
        }
    }

    public function updatedSearch()
    {

        if(strlen($this->search) < 2){
            $this->reset('results');
            return;
        }

        $this->results = Asociado::with('area')
            ->whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($this->search) . '%'])
            ->whereNotIn('id', array_keys($this->selectedManagers))
            ->take(5)
            ->get();

    }

    public function addManager($id, $nombre, $area)
    {
        $this->selectedManagers[$id] = [
            'nombre' => $nombre,
            'area' => $area
        ];

        $this->reset(['search', 'results']);
    }

    public function removeManager($id)
    {
        unset($this->selectedManagers[$id]);
    }

};
?>

<div class="border-t border-gray-600 pt-2">
    <x-input-form-label for="asociados">Agregar Encargados Del Mercado</x-input-form-label>
    <x-input-form
        type="text"
        placeholder="Elmer Homero"
        value=""
        name="asociados"
        wire:model.live.debounce="search"
        wire:key="buscar-encargados-{{$search}}"/>

    @if(!empty($results))

        <div class="text-md pt-2">
            @foreach($results as $asociado)
                <p wire:click="addManager({{$asociado->id}}, '{{$asociado->nombre}}', '{{$asociado->area->nombre}}')" class="cursor-pointer font-bold">{{$asociado->nombre}} - {{$asociado->area->nombre}}</p>
            @endforeach
        </div>

    @endif

    @if(!empty($selectedManagers))

        <x-index-div-table class="pt-2">
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>Nombre</x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>Area</x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column class="text-red-800">Eliminar</x-index-div-table-thead-th-column>
            </x-index-div-table-thead>

            <x-index-div-table-tbody>
                @foreach($selectedManagers as $id => $asociado)
                    <tr wire:key="table-row-{{$id}}">
                        <td>{{$asociado['nombre']}}</td>
                        <td>{{$asociado['area']}}</td>
                        <td>
                            <button wire:click.prevent="removeManager({{$id}})" class="text-red-600 font-bold text-xl w-full">
                                X
                            </button>
                            <input type="hidden" name="asociados[]" value="{{$id}}">
                        </td>
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>

    @endif

</div>
