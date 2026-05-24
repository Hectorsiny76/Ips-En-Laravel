<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estado;

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

        $query = Estado::query();

        if ($this->search !== '') {
            $query = Estado::search($this->search);
        }

        $estados = $query->latest()->paginate(10);

        return view('admin.livewire.estados.⚡index-table', [
            'estados' => $estados
        ]);
    }
};
?>

<div>

    <x-index-table-searchable-input
        title="Buscar Estados"
        variable="search"
        />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                No
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Nombre
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($estados as $estado)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$estado->nombre}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.estados.edit', $estado->id)}}"
                        formaction="{{ route('admin.estados.destroy', $estado->id) }}"
                        formconfirm="¿Está seguro de que desea eliminar este estado?"
                    />
                    <x-table-td-fd-routing
                        href="{{ route('admin.estados.gerentes-mercado.index', $estado->id) }}"
                    >
                        Gerentes de Mercado
                    </x-table-td-fd-routing>
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

    <x-index-table-pagination :variable="$estados"/>

</div>
