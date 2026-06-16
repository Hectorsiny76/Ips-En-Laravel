<?php

use Livewire\Component;
use App\Models\Establecimiento;
use Livewire\Attributes\Session;

new class extends Component {

    #[Session]
    public $busqueda = '';

    #[Session]
    public ?Establecimiento $selectedEst = null;

    public $ests = [];

    public function updatedBusqueda()
    {
        $this->ests = Establecimiento::search($this->busqueda)->take(5)->get();
    }

    public function selectEst($id)
    {
        $this->selectedEst = Establecimiento::findOrFail($id);
        $this->reset(['busqueda', 'ests']);
    }

    public function limpiar()
    {
        $this->reset(['ests', 'selectedEst', 'busqueda']);
    }

};
?>

<div class="h-full pt-2">
    <div x-data="{ open: false }" class="relative">
        <div class="flex w-full justify-between items-center h-full pb-2">
            <input type="text"
                   class="mb-0 w-full p-2 border rounded-md text-xs lg:text-lg"
                   placeholder="Escribe el nombre, numero o centro de costos de una tienda"
                   wire:model.live.debounce="busqueda"
                   x-on:focus="open = true"
                   x-on:click.away="open = false"
            >
            <button type="submit" wire:click="limpiar"
                    class="bg-green-800 text-white rounded mx-1 p-2 lg:p-1  h-full">Limpiar
            </button>
        </div>

        <div x-cloak x-show="open" class="border-gray-300 bg-white rounded border absolute z-50 max-h-60 overflow-auto w-full {{ !empty($busqueda) ? 'block' : 'hidden' }}">
            @forelse ($ests as $est)
                <div wire:key="est-{{$est->id}}"
                     class="w-full mt-1"
                     x-on:click="open = false"
                    >
                    <p wire:click="selectEst({{ $est->id }})"
                        class="cursor-pointer w-full pb-2 pl-2 hover:text-blue-800"
                        >
                            {{ $est->numero }} {{ $est->nombre }} {{ $est->centrodecostos ?: '' }}
                    </p>
                </div>
            @empty
                <p class="w-full text-gray-800 p-2">No se encontraron resultados</p>
            @endforelse

        </div>

    </div>

    <div class="flex-1 min-h-0 flex overflow-auto flex-col">
        @if($selectedEst)
            <p>{{$selectedEst->nombre}}</p>
        @endif
    </div>

</div>
