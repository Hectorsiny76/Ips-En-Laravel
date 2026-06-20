<?php

use App\Models\Clasificacione;
use Livewire\Component;
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
        $query = Clasificacione::with(['categoria', 'subcategoria', 'servicio', 'microservicio']);

        if ($this->search !== '') {
            $searchString = '%' . strtolower($this->search) . '%';

            $query = Clasificacione::search($searchString);
        }

        $clasificaciones = $query->latest()->paginate(10);

        return view('user.livewire.tabs-index.tabs.⚡buscar-clasificaciones', [
            'clasificaciones' => $clasificaciones
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input title="Buscar Clasificaciones" variable="search"/>

    <x-index-table-pagination :variable="$clasificaciones"/>

    <x-livewire-content-div class="pt-3">
        <x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
            <x-index-div-table-thead-user>
                <x-index-div-table-thead-th-column-user>
                    No
                </x-index-div-table-thead-th-column-user>
                <x-index-div-table-thead-th-column-user>
                    Categoría
                </x-index-div-table-thead-th-column-user>
                <x-index-div-table-thead-th-column-user>
                    Subcategoría
                </x-index-div-table-thead-th-column-user>
                <x-index-div-table-thead-th-column-user>
                    Servicio
                </x-index-div-table-thead-th-column-user>
                <x-index-div-table-thead-th-column-user>
                    Microservicio
                </x-index-div-table-thead-th-column-user>
            </x-index-div-table-thead-user>
            <x-index-div-table-tbody>
                @foreach($clasificaciones as $clasificacione)
                    <tr>
                        <x-index-div-table-tbody-tr-td>
                            {{$loop->iteration}}
                        </x-index-div-table-tbody-tr-td>
                        <x-index-div-table-tbody-tr-td>
                            {{$clasificacione->categoria->nombre}}
                        </x-index-div-table-tbody-tr-td>
                        <x-index-div-table-tbody-tr-td>
                            {{$clasificacione->subcategoria->nombre}}
                        </x-index-div-table-tbody-tr-td>
                        <x-index-div-table-tbody-tr-td>
                            {{$clasificacione->servicio->nombre}}
                        </x-index-div-table-tbody-tr-td>
                        <x-index-div-table-tbody-tr-td>
                            {{$clasificacione->microservicio->nombre}}
                        </x-index-div-table-tbody-tr-td>
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
