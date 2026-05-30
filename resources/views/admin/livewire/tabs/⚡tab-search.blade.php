<?php

use App\Models\Establecimiento;
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
        $query = Establecimiento::with(['establecimientotipo', 'campogerente', 'cluster', 'tidelprograma', 'tiendaformato', 'avaloncontrato']);

        if ($this->search !== '') {
            $searchString = strtolower($this->search);

            $query = Establecimiento::search($searchString);
        }

        $establecimientos = $query->latest()->paginate(10);

        return view('admin.livewire.tabs.⚡tab-search', [
            'establecimientos' => $establecimientos
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input title="Buscar Establecimientos" variable="search"/>

    <x-index-table-pagination :variable="$establecimientos"/>

    <x-livewire-content-div>
        <x-index-div-table>
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    Tipo
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Numero
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Nombre
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Centro de Costos
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Gerente de Campo
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Tidel
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Formato
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Contrato
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
                @foreach($establecimientos as $est)
                    <tr>
                        <td>
                            {{$est->establecimientotipo->nombre}}
                        </td>
                        <td>
                            {{$est->numero}}
                        </td>
                        <td>
                            {{$est->nombre}}
                        </td>
                        <td>
                            {{$est->centrodecostos ?? 'N/A'}}
                        </td>
                        <td>
                            {{$est->campogerente->nombre}}
                        </td>
                        <td>
                            {{$est->tidelprograma->ip ?? 'N/A'}}
                        </td>
                        <td>
                            {{$est->tiendaformato->nombre ?? 'N/A'}}
                        </td>
                        <td>
                            {{$est->avaloncontrato->numero ?? 'N/A'}}
                        </td>
                        <x-table-td-actions
                            ahref="{{route('admin.establecimientos.edit', $est->id)}}"
                            formaction="{{ route('admin.establecimientos.destroy', $est->id) }}"
                            formconfirm="¿Esta seguro de eliminar esta clasificación?"
                        />
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
