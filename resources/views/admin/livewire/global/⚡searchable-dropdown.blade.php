<?php

use Livewire\Component;

new class extends Component
{
    // Configuración obtenida del componente padre

    public $model; // Modelo a trabajar Ej: App\Models\Estado
    public $searchColumn; // Columna a buscar Ej: 'nombre'
    public $fieldToUpdate; // Campo a actualizar Ej: 'estado_id'
    public $placeholder = 'Buscar...';

    // Estado a cambiar de este componente

    public $search = '';
    public $selectedId = null;
    public $selectedName = '';

    public function mount($initialId = null, $initialName = '')
    {
        $this->selectedId = $initialId;
        $this->selectedName = $initialName;
        $this->search = '';

        $this->dispatch('dropdown-selected', field: $this->fieldToUpdate, id: $this->selectedId);
    }

    public function selectItem($id, $name)
    {
        $this->selectedId = $id;
        $this->selectedName = $name;
        $this->search = '';

        // Pasar el evento al componente padre
        $this->dispatch('dropdown-selected', field: $this->fieldToUpdate, id: $id);
    }

    public function clearSelection()
    {
        $this->selectedId = null;
        $this->selectedName = '';

        $this->dispatch('dropdown-selected', field: $this->fieldToUpdate, id: null);
    }

    public function render()
    {
        $results = [];

        if (strlen($this->search) >= 2){
            $results = $this->model::whereRaw('LOWER('.$this->searchColumn.') like ?', ['%'.strtolower($this->search).'%'])
                ->take(5)
                ->get();
        }

        return view('admin.livewire.global.⚡searchable-dropdown',[
            'results' => $results
        ]);
    }
};
?>

<div class="mb-4">
    @if($selectedId)
        <div class="flex items-center justify-between p-3 border border-sky-500 rounded bg-sky-50 dark:border-sky-600 dark:bg-sky-900">
            <span class="font-bold text-sky-700 dark:text-sky-500">{{$selectedName}}</span>
            <button type="button" wire:click.prevent="clearSelection" class="dark:text-gray-400 dark:hover:text-gray-200 text-sm text-gray-800">
                Cambiar
            </button>
        </div>
    @else
        <div x-data="{ open: false }" class="relative">
            <x-input-form
                id="search-{{$fieldToUpdate}}"
                type="text"
                wire:model.live.debounce.300ms="search"
                x-on:focus="open = true"
                x-on:click.away="open = false"
                placeholder="{{$placeholder}}"
                autocomplete="off"
            />
            @if(count($results) > 0)
                <div
                    x-cloak
                    x-show="open"
                    class="absolute z-10 w-full  dark:bg-gray-800 bg-white border rounded shadow-lg"
                    style="display: none;"
                >
                    <ul class="max-h-60 overflow-y-auto">
                        @foreach($results as $result)
                            <li
                                wire:key="item-{{$fieldToUpdate}}-{{$result->id}}"
                                wire:click="selectItem({{$result->id}}, '{{ $result->{$searchColumn} }}')"
                                x-on:click="open = false"
                                class="p-2 border-transparent rounded cursor-pointer dark:text-gray-300 dark:hover:bg-blue-900/50 hover:bg-blue-500 hover:text-white"
                            >
                                {{ $result->{$searchColumn} }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif
</div>
