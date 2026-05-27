<?php

use App\Models\Clasificacione;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
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

        return view('admin.livewire.clasificaciones.⚡index-table', [
            'clasificaciones' => $clasificaciones
        ]);
    }
};
?>

<div class="overflow-auto">

    <x-index-table-searchable-input title="Buscar Clasificaciones" variable="search"/>

    <x-index-table-pagination :variable="$clasificaciones"/>

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                No
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Categoría
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Subcategoría
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Servicio
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Microservicio
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($clasificaciones as $clasificacione)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$clasificacione->categoria->nombre}}
                    </td>
                    <td>
                        {{$clasificacione->subcategoria->nombre}}
                    </td>
                    <td>
                        {{$clasificacione->servicio->nombre}}
                    </td>
                    <td>
                        {{$clasificacione->microservicio->nombre}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.clasificaciones.edit', $clasificacione->id)}}"
                        formaction="{{ route('admin.clasificaciones.destroy', $clasificacione->id) }}"
                        formconfirm="¿Esta seguro de eliminar esta clasificación?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

</div>
