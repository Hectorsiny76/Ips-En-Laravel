<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tidelprograma;

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
        $query = Tidelprograma::with('establecimiento');

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $tidelprogramas = $query->latest()->paginate(10);

        return view('admin.livewire.tidel-programas.⚡index-table', [
            'tidelprogramas' => $tidelprogramas
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input
        variable="search"
        title="Buscar un programa tidel"
        />

    <x-index-table-pagination
        :variable="$tidelprogramas"
        />

    <x-livewire-content-div>
        <x-index-div-table>

            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    Tienda
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Ip
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Fecha Migración
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>

            <x-index-div-table-tbody>
                @foreach($tidelprogramas as $tidelprograma)
                    <tr>
                        <td>
                            {{$tidelprograma->establecimiento?->nombre ?? 'No hay establecimiento asignado'}}
                        </td>
                        <td>
                            {{$tidelprograma->ip}}
                        </td>
                        <td>
                            {{$tidelprograma->fechamigracion ?? 'Sin fecha'}}
                        </td>
                        <x-table-td-actions
                            ahref="{{route('admin.tidel-programas.edit', $tidelprograma->id)}}"
                            formaction="{{ route('admin.tidel-programas.destroy', $tidelprograma->id) }}"
                            formconfirm="¿Esta seguro de desear eliminar esta migración?"
                            warning="¡Esta acción no se puede deshacer!"
                        />
                    </tr>
                @endforeach
            </x-index-div-table-tbody>

        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
