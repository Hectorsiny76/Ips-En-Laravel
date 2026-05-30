<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cajatipoestablecimiento;

new class extends Component {
    public $search = '';

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Cajatipoestablecimiento::with('cajatipo', 'establecimiento');

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $estsCajaTipos = $query->latest()->paginate(10);

        return view('admin.livewire.cajatipo-establecimiento.⚡index-table', [
            'estsCajaTipos' => $estsCajaTipos
        ]);
    }
};
?>

<div class="overflow-y-auto">

    <x-index-table-searchable-input
        title="Buscar un establecimiento, tipo de caja o numero de caja"
        variable="search"
    />

    <x-index-table-pagination
        :variable="$estsCajaTipos"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Fila
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Establecimiento
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Tipo de Caja
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Numero de Caja
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($estsCajaTipos as $estCajatipo)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$estCajatipo->establecimiento->nombre}}
                    </td>
                    <td>
                        {{$estCajatipo->cajatipo->nombre}}
                    </td>
                    <td>
                        {{$estCajatipo->numcaja}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.cajatipo-establecimiento.edit', $estCajatipo->id)}}"
                        formaction="{{ route('admin.cajatipo-establecimiento.destroy', $estCajatipo->id) }}"
                        formconfirm="¿Esta seguro de eliminar esta relación de la base de datos?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

</div>
