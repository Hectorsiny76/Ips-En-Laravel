<?php

use Livewire\Component;
use App\Models\Establecimiento;

new class extends Component {

    public $busqueda = '';

    public $ests = [];

    public function updatedBusqueda($valor)
    {

        $this->ests = Establecimiento::search($valor)->take(10)->get();


    }



    public function limpiar()
    {
        $this->busqueda = '';
        $this->ests = [];
    }

};
?>

<div>
    <div class="grid grid-cols-7 gap-4">
        <div class="flex-col col-span-6">
            <input type="text" placeholder="Escribe el nombre, numero o centro de costos de una tienda"
                wire:model.live.debounce.800ms="busqueda">
        </div>

        <div class="flex flex-col col-span-1 ">
            <form action="{{ route('main.index') }}">
                <button type="submit" wire:click="limpiar"
                    class="bg-green-800 text-white p-2 rounded w-full">Limpiar</button>
            </form>
        </div>


        <div class=" col-span-7 pt-2 border-2 border-gray-300 rounded {{ !empty($busqueda) ? 'block' : 'hidden' }}">
            @foreach ($ests as $est)
                <div class="w-full">
                    <a href="{{ route('user.main.show', $est->id) }}">
                        <p class="w-full pb-2 pl-2 hover:text-blue-800 ">{{ $est->numero }} {{ $est->nombre }}
                            {{ $est->centrodecostos ?: '' }}
                        </p>
                    </a>
                </div>
            @endforeach

            @if(count($ests) == 0)
                <p class="w-full text-gray-800">No se encontraron resultados</p>
            @endif

        </div>

    </div>
</div>