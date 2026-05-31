<?php

use Livewire\Component;
use App\Models\Establecimiento;

new class extends Component
{
    #[Validate('required')]
    public $searchText = '';

    public $results = [];

    public $selectedEst = [];

    public function mount($estAdded = null)
    {
        if($estAdded){
            $this->selectedEst = $estAdded->pluck('nombre', 'id')->toArray();
        }
    }

    public function updatedSearchText($value)
    {
        $this->reset('results');

        $this->results = Establecimiento::search($value)
            ->whereNotIn('id', array_keys($this->selectedEst))
            ->take(5)
            ->get();
    }

    public function addEst($id, $name)
    {
        $this->selectedEst[$id] = $name;

        $this->reset(['searchText', 'results']);
    }

    public function removeEst($id)
    {
        unset($this->selectedEst[$id]);
    }

    public function clear()
    {
        $this->reset('searchText', 'results');
    }
};
?>

<div>
    <div class="mt-2">
            <x-input-form-label for="buscar-tiendas">Tiendas Relacionadas</x-input-form-label>
            <div class="flex justify-between w-full">
                <x-input-form
                    id="buscar-tiendas"
                    type="text"
                    placeholder="Busca una tienda"
                    wire:model.live.debounce="searchText"
                    class="w-full rounded-md border"
                    wire:key="buscar-tiendas{{$searchText}}"
                />
                <button
                    class="border rounded-md dark:disabled:bg-indigo-400/50 dark:bg-indigo-800/50 dark:hover:bg-indigo-700 bg-indigo-600 px-2 text-white ml-2 disabled:bg-indigo-400"
                    wire:click.prevent="clear()"
                    {{empty($searchText) ? 'disabled' : '' }}
                >
                    Limpiar
                </button>
            </div>
        @if(!empty($searchText))
            <ul class="w-full my-2 border rounded shadow-lg">
                @forelse($results as $est)
                    <li
                        wire:click="addEst({{$est->id}}, '{{$est->nombre}}')"
                        class="my-2 mx-2 hover:text-gray-500 dark:text-gray-200 dark:hover:text-gray-500 cursor-pointer">
                        {{$est->numero.' '.$est->nombre.' '.$est->centrodecostos ?? ''}}
                    </li>

                @empty

                    <li
                        class="my-2 mx-2 dark:text-gray-200">
                        Sin resultados
                    </li>

                @endforelse
            </ul>
        @endif
        <div class="flex flex-wrap mt-4 gap-2">
            @foreach($selectedEst as $id => $name)

                <input type="hidden" name="establecimientos[]" value="{{$id}}">

                <span
                    class="inline-flex items-center bg-gray-600 text-white text-sm rounded px-3 py-1"
                    wire:key="selected-est{{$id}}"
                >
                    {{$name}}
                    <button
                        class="ml-2 text-white hover:text-red-400 font-bold"
                        wire:click.prevent="removeEst({{$id}})"
                        type="button"
                    >
                        &times;
                    </button>
                </span>
            @endforeach
        </div>
    </div>
</div>
