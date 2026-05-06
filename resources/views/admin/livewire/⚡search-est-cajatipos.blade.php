<?php

use Livewire\Component;
use App\Models\Establecimiento;

new class extends Component
{
    #[Validate('required')]
    public $searchText = '';
    public $results = [];

    public $selectedEsts = [];

    public function updatedSearchText($value)
    {
        $this->reset('results');

        $this->results = Establecimiento::search($value)
            ->whereNotIn('id', array_keys($this->selectedEsts))
            ->take(5)
            ->get();
    }

    public function addEst($id, $name)
    {
        $this->selectedEsts[$id] = [
            'nombre' => $name,
            'numcaja' => 1 // Valor por default cada que se agregue una fila nueva
        ];

        $this->reset(['searchText', 'results']);
    }

    public function removeEst($id)
    {
        unset($this->selectedEsts[$id]);
    }

    public function mount($estAdded = null)
    {
        if($estAdded) {
            foreach ($estAdded as $est) {
                $this->selectedEsts[$est->id] = [
                    'nombre' => $est->nombre,
                    'numcaja' => $est->pivot->numcaja
                ];
            }
        }
    }

    public function clear()
    {
        $this->reset('searchText', 'results');
    }
};
?>

<div>
    <div class="mt-2">
        <x-input-form-label for="buscar-tiendas">Tiendas existentes</x-input-form-label>
        <div class="flex justify-between w-full">
            <input
                id="buscar-tiendas"
                type="text"
                placeholder="Busca una tienda"
                wire:model.live.debounce="searchText"
                class="w-full rounded-md border"
                wire:key="buscar-tiendas{{$searchText}}"
            >
            <button
                class="border rounded-md bg-indigo-600 px-2 text-white ml-2 disabled:bg-indigo-400"
                wire:click.prevent="clear()"
                {{empty($searchText) ? 'disabled' : '' }}
            >
                Limpiar
            </button>
        </div>
        @if(!empty($searchText))
            <ul class="w-full my-2 border rounded shadow-lg">
                @foreach($results as $est)
                    <li
                        wire:click="addEst({{$est->id}}, '{{$est->nombre}}')"
                        class="my-2 mx-2 hover:text-gray-500 cursor-pointer">
                        {{$est->numero.' '.$est->nombre.' '.$est->centrodecostos ?? ''}}
                    </li>
                @endforeach
            </ul>
        @endif
        <x-index-div-table class="mt-4">
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>No</x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>Nombre Establecimiento</x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>Caja</x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column class="text-center">Eliminar</x-index-div-table-thead-th-column>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
                @foreach($selectedEsts as $id => $details)
                    <tr wire:key="est-{{$id}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$details['nombre']}}</td>
                        <td>
                            <input
                                type="number"
                                wire:model.live="selectedEsts.{{ $id }}.numcaja"
                                class="border p-1 w-20 rounded-md"
                                min="1"
                                max="30"
                            >
                        </td>
                        <td class="text-center">
                            <button
                                type="button"
                                wire:click="removeEst({{$id}})"
                                class="text-md font-bold hover:text-red-800"
                            >
                                X
                            </button>
                            <input
                                type="hidden"
                                name="establecimientos[{{$id}}][numcaja]"
                                value="{{ $details['numcaja'] }}"
                            >
                        </td>
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>
    </div>
</div>
