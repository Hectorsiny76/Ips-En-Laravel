<?php

use Livewire\Component;
use App\Models\Establecimiento;

new class extends Component {

    public $busqueda = '';

    public $ests = [];

    public Establecimiento $selectedEst;

    public function updatedBusqueda()
    {
        $this->ests = Establecimiento::search($this->busqueda)->take(10)->get();
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

<div>
    <div class="grid grid-cols-7 gap-4">
        <div class="flex-col col-span-6">
            <input type="text" placeholder="Escribe el nombre, numero o centro de costos de una tienda"
                   wire:model.live.debounce="busqueda">
        </div>

        <div class="flex flex-col col-span-1 ">
            <form action="{{ route('main.index') }}">
                <button type="submit" wire:click="limpiar"
                        class="bg-green-800 text-white p-2 rounded w-full">Limpiar
                </button>
            </form>
        </div>


        <div class=" col-span-7 pt-2 border-2 border-gray-300 rounded {{ !empty($busqueda) ? 'block' : 'hidden' }}">
            @foreach ($ests as $est)
                <div wire:key="est-{{$est->id}}" class="w-full">
                    <p
                        wire:click="selectEst({{ $est->id }})"
                        class="cursor-pointer w-full pb-2 pl-2 hover:text-blue-800"
                    >
                        {{ $est->numero }} {{ $est->nombre }} {{ $est->centrodecostos ?: '' }}
                    </p>
                </div>
            @endforeach

            @if(count($ests) == 0)
                <p class="w-full text-gray-800">No se encontraron resultados</p>
            @endif
        </div>

        @if($selectedEst)
            <p>Hola</p>
        @endif

    </div>
</div>
