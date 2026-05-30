<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Despliegue;

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
        $query = Despliegue::with('area');

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $despliegues = $query->latest()->paginate(10);

        return view('admin.livewire.despliegues.⚡index-table', [
            'despliegues' => $despliegues
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input
        title="Buscar un despliegue"
        variable="search"
        />

    <x-index-table-pagination :variable="$despliegues"/>

    <x-livewire-content-div>
        <x-index-div-table>
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    Titulo
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Descripcion
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Area
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Inicio
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Fin
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
                @foreach($despliegues as $despliegue)
                    <tr>
                        <td>
                            {{$despliegue->titulo}}
                        </td>
                        <td>
                            {{$despliegue->descripcion}}
                        </td>
                        <td>
                            {{$despliegue->area->nombre}}
                        </td>
                        <td>
                            {{$despliegue->inicio}}
                        </td>
                        <td>
                            {{$despliegue->fin}}
                        </td>
                        <x-table-td-actions
                            ahref="{{route('admin.despliegues.edit', $despliegue->id)}}"
                            formaction="{{ route('admin.despliegues.destroy', $despliegue->id) }}"
                            formconfirm="¿Esta seguro de eliminar este despliegue?"
                        />
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>
    </x-livewire-content-div>
</x-livewire-parent-div>
