<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Binomioestablecimiento;

new class extends Component
{
    public $search = '';

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Binomioestablecimiento::with('tienda', 'estacion');

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $estBinomios = $query->latest()->paginate(10);

        return view('admin.livewire.binomioestablecimientos.⚡index-table', [
            'estBinomios' => $estBinomios
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input
        title="Buscar una tienda o estación"
        variable="search"
        />

    <x-index-table-pagination
        :variable="$estBinomios"
        />

    <x-livewire-content-div>
        <x-index-div-table>
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    Fila
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Tienda
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    No. Tienda
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Estación
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Centro De Costos
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
                @foreach($estBinomios as $estBinomio)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$estBinomio->tienda->nombre}}
                        </td>
                        <td>
                            {{$estBinomio->tienda->numero}}
                        </td>
                        <td>
                            {{$estBinomio->estacion->nombre}}
                        </td>
                        <td>
                            {{$estBinomio->estacion->centrodecostos ?? 'N/A'}}
                        </td>
                        <x-table-td-actions
                            ahref="{{route('admin.binomioestablecimientos.edit', $estBinomio->id)}}"
                            formaction="{{ route('admin.binomioestablecimientos.destroy', $estBinomio->id) }}"
                            formconfirm="¿Esta seguro de eliminar esta duo de establecimientos de la lista?"
                        />
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
