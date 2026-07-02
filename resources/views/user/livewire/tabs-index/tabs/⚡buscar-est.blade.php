<?php

use Livewire\Component;
use App\Models\Establecimiento;
use Livewire\Attributes\Session;
use App\Services\SucursalService;
use Livewire\Attributes\Computed;

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

    #[Computed]
    public function establecimientosRelacionados()
    {
        return Establecimiento::where('campogerente_id', $this->selectedEst->campogerente_id)
            ->pluck('numero')
            ->toArray();
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

            <x-index-table-result-divider-h2>Información Principal</x-index-table-result-divider-h2>

            <x-index-table-first-level-user :selected-est="$selectedEst"/>

            <x-index-table-second-level-user
                :selected-est="$selectedEst"
                :tienda-string="SucursalService::$tiendaString"
                :estacion-string="SucursalService::$estacionString"
                :est-tipo-nombre="SucursalService::slug($selectedEst->establecimientotipo->nombre)"
            />

            <x-index-table-third-level-user :selected-est="$selectedEst"/>

            @if($this->establecimientosRelacionados > 0)

                <x-index-table-result-divider-h2>Establecimientos Relacionados</x-index-table-result-divider-h2>

                <x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
                    <x-index-div-table-thead-user>
                        <x-index-div-table-thead-th-column-user>Número</x-index-div-table-thead-th-column-user>
                    </x-index-div-table-thead-user>
                    <x-index-div-table-tbody>
                        <tr>
                            <td>
                                <div class="flex justify-evenly w-full flex-row divide-x-2 divide-gray-200">
                                    @foreach($this->establecimientosRelacionados as $numero)
                                        @if($selectedEst->numero !== $numero)
                                            <span class="w-full text-center">{{$numero}}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </x-index-div-table-tbody>
                </x-index-div-table>
            @endif

            @if($selectedEst->pilotoprogramas()->exists())

                <x-index-table-result-divider-h2>Programas Piloto</x-index-table-result-divider-h2>

                <x-index-table-fourth-level-user :selected-est="$selectedEst"/>

            @endif

            @if($selectedEst->cajatipoestablecimiento()->exists())

                <x-index-table-result-divider-h2>Tipos de Caja</x-index-table-result-divider-h2>

                <x-index-table-fifth-level-user :selected-est="$selectedEst"/>

            @endif

        @else
            <div class="flex flex-col p-8 items-center justify-center text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                </svg>
                <span class="pt-2 select-none">Busca un establecimiento para mostrar su información aquí.</span>
            </div>
        @endif
    </x-livewire-content-div>

</div>
