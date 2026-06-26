<?php

use Livewire\Component;
use App\Models\Establecimiento;
use Livewire\Attributes\Session;
use App\Services\SucursalService;

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
        $this->selectedEst->load([
            'campogerente', 'campo', 'mercado', 'mercadogerente', 'estado', 'establecimientotipo',
            'cluster', 'tidelprograma', 'tiendaformato', 'pilotoprogramas', 'cajatipoestablecimiento.cajatipo',
            'avaloncontrato', 'binomioestacion', 'binomiotienda'
        ]);
        $this->reset(['busqueda', 'ests']);
    }

    public function limpiar()
    {
        $this->reset(['ests', 'selectedEst', 'busqueda']);
    }

};
?>

<div class="flex flex-col h-full ">
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

    <x-livewire-content-div class="p-2 pt-3">
        @if($selectedEst)

            <x-index-table-first-level-user :selected-est="$selectedEst"/>

            <x-index-table-second-level-user
                :selected-est="$selectedEst"
                :tienda-string="SucursalService::$tiendaString"
                :estacion-string="SucursalService::$estacionString"
                :est-tipo-nombre="SucursalService::slug($selectedEst->establecimientotipo->nombre)"
            />

            <x-index-table-third-level-user :selected-est="$selectedEst"/>

            @if($selectedEst->pilotoprogramas()->exists())
                <x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
                    <x-index-div-table-thead-user>
                        <x-index-div-table-thead-th-column-user>Titulo</x-index-div-table-thead-th-column-user>
                        <x-index-div-table-thead-th-column-user>Descripción</x-index-div-table-thead-th-column-user>
                    </x-index-div-table-thead-user>
                    <x-index-div-table-tbody>
                        @foreach($selectedEst->pilotoprogramas as $programa)
                            <tr>
                                <x-index-div-table-tbody-tr-td>{{$programa->titulo}}</x-index-div-table-tbody-tr-td>
                                <x-index-div-table-tbody-tr-td>{{$programa->descripcion_corta}}</x-index-div-table-tbody-tr-td>
                            </tr>
                        @endforeach
                    </x-index-div-table-tbody>
                </x-index-div-table>
            @endif

            @if($selectedEst->cajatipoestablecimiento()->exists())
                <x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
                    <x-index-div-table-thead-user>
                        <x-index-div-table-thead-th-column-user>Tipo de Caja</x-index-div-table-thead-th-column-user>
                        <x-index-div-table-thead-th-column-user>Número</x-index-div-table-thead-th-column-user>
                    </x-index-div-table-thead-user>
                    <x-index-div-table-tbody>
                        @foreach($selectedEst->cajatipoestablecimiento as $caja)
                            <tr>
                                <x-index-div-table-tbody-tr-td>{{$caja->cajatipo->nombre}}</x-index-div-table-tbody-tr-td>
                                <x-index-div-table-tbody-tr-td>{{$caja->numcaja}}</x-index-div-table-tbody-tr-td>
                            </tr>
                        @endforeach
                    </x-index-div-table-tbody>
                </x-index-div-table>
            @endif

        @endif
    </x-livewire-content-div>

</div>
