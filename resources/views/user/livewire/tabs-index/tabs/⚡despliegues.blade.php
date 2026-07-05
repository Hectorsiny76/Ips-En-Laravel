<?php

use Livewire\Component;
use App\Models\Despliegue;
use Livewire\WithPagination;
use Livewire\Attributes\Session;

new class extends Component {
    #[Session]
    public $search = '';

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $query = Despliegue::with('area');

        if ($this->search !== '') {
            $searchString = '%' . strtolower($this->search) . '%';

            $query = Despliegue::search($searchString);
        }

        $despliegues = $query->latest()->paginate(10);

        return view('user.livewire.tabs-index.tabs.⚡despliegues', [
            'despliegues' => $despliegues
        ]);
    }

};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input title="Buscar Despliegues" variable="search"/>

    <x-index-table-pagination :variable="$despliegues"/>

    <x-livewire-content-div class="pt-3">
        <x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
            <x-index-div-table-thead-user>
                <x-index-div-table-thead-th-column-user>
                    Título
                </x-index-div-table-thead-th-column-user>
                <x-index-div-table-thead-th-column-user>
                    Descripción
                </x-index-div-table-thead-th-column-user>
                <x-index-div-table-thead-th-column-user>
                    Área
                </x-index-div-table-thead-th-column-user>
                <x-index-div-table-thead-th-column-user>
                    Inicio
                </x-index-div-table-thead-th-column-user>
                <x-index-div-table-thead-th-column-user>
                    Fin
                </x-index-div-table-thead-th-column-user>
            </x-index-div-table-thead-user>
            <x-index-div-table-tbody>
                @forelse($despliegues as $despliegue)
                    <tr>
                        <x-index-div-table-tbody-tr-td>
                            {{$despliegue->titulo}}
                        </x-index-div-table-tbody-tr-td>
                        <x-index-div-table-tbody-tr-td>
                            {{$despliegue->descripcion}}
                        </x-index-div-table-tbody-tr-td>
                        <x-index-div-table-tbody-tr-td>
                            {{$despliegue->area->nombre}}
                        </x-index-div-table-tbody-tr-td>
                        <x-index-div-table-tbody-tr-td>
                            {{$despliegue->inicio}}
                        </x-index-div-table-tbody-tr-td>
                        <x-index-div-table-tbody-tr-td>
                            {{$despliegue->fin}}
                        </x-index-div-table-tbody-tr-td>
                    </tr>
                @empty
                    <tr>
                        <x-index-div-table-tbody-tr-td colspan="5">
                            <x-index-search-table-no-results/>
                        </x-index-div-table-tbody-tr-td>
                    </tr>
                @endforelse
            </x-index-div-table-tbody>
        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
