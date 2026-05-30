<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Area;

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
        $query = Area::withCount('asociados');

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $areas = $query->latest()->paginate(10);

        return view('admin.livewire.areas.⚡index-table', [
            'areas' => $areas
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input
        title="Buscar un área"
        variable="search"
        />

    <x-index-table-pagination :variable="$areas"/>

    <x-livewire-content-div>
        <x-index-div-table>
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    No
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Nombre
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Descripcion
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    No. Asociados
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
                @foreach($areas as $area)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$area->nombre}}
                        </td>
                        <td>
                            {{$area->descripcion}}
                        </td>
                        <td>
                            {{$area->asociados_count}}
                        </td>
                        <x-table-td-actions
                            ahref="{{route('admin.areas.edit', $area->id)}}"
                            formaction="{{ route('admin.areas.destroy', $area->id) }}"
                            formconfirm="¿Esta seguro de eliminar este tipo de folio?"
                        />
                        <x-table-td-fd-routing href="{{route('admin.areas.asociados.index', $area->id)}}">
                            Asociados
                        </x-table-td-fd-routing>
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
