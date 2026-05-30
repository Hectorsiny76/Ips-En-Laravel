<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pilotoprograma;

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
        $query = Pilotoprograma::withCount('establecimientos');

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $pilotoProgramas = $query->latest()->paginate(10);

        return view('admin.livewire.programas-piloto.⚡index-table', [
            'pilotoProgramas' => $pilotoProgramas
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input
        title="Buscar un programa piloto"
        variable="search"
        />

    <x-index-table-pagination :variable="$pilotoProgramas"/>

    <x-livewire-content-div>
        <x-index-div-table>
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    No
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Titulo
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Descripción Corta
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Establecimientos relacionados
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
                @foreach($pilotoProgramas as $pilotoPrograma)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$pilotoPrograma->titulo}}
                        </td>
                        <td>
                            {{$pilotoPrograma->descripcion_corta}}
                        </td>
                        <td>
                            {{$pilotoPrograma->establecimientos_count}}
                        </td>
                        <x-table-td-actions
                            ahref="{{route('admin.programas-piloto.edit', $pilotoPrograma->id)}}"
                            formaction="{{ route('admin.programas-piloto.destroy', $pilotoPrograma->id) }}"
                            formconfirm="¿Esta seguro de eliminar esta duo de establecimientos de la lista?"
                        />
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>
    </x-livewire-content-div>
</x-livewire-parent-div>
