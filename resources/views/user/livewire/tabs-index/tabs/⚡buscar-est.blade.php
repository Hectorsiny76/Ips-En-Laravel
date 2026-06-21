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

<div class="h-full">
    <div x-data="{ open: false }" class="relative">
        <div class="h-full">
            <x-input-form-label class="my-0" for="buscar">Buscar Establecimientos</x-input-form-label>
            <div class="flex w-full justify-between items-center">
                <input type="text"
                      class="mb-0 w-full border rounded-md text-xs lg:text-lg focus:ring-green-700 focus:border-green-700"
                      placeholder="Escribe el nombre, numero o centro de costos de una tienda"
                      wire:model.live.debounce="busqueda"
                      x-on:focus="open = true"
                      x-on:click.away="open = false"
                >
                <button type="submit" wire:click="limpiar"
                        class="bg-gradient-to-r from-green-700 to-green-900 hover:from-green-600 hover:to-green-800 text-white rounded mx-1 p-2 lg:p-1  h-full">Limpiar
                </button>
            </div>
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
