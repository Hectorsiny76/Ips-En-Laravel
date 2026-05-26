<?php

use App\Models\Estado;
use App\Models\Mercadogerente;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {

    public $search = '';

    public Estado $estado;

    public $mercadogerentes;

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount($estado)
    {
        $this->estado = $estado;
    }

    public function render()
    {
        $query = $this->estado->mercadogerentes();

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $gerentes = $query->latest()->paginate(10);

        $gerentes->load('mercado');

        return view('admin.livewire.gerentes-mercado.⚡index-table', [
            'gerentes' => $gerentes
        ]);
    }
};
?>

<div class="overflow-y-auto">

    <x-index-table-searchable-input
        title="Buscar Gerentes de Mercado"
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
            <x-index-div-table-thead-th-column>
                Mercado
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($gerentes as $gerente)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$gerente->nombre}}
                    </td>
                    <td>
                        {{$gerente->mercado?->numero ?? 'Sin mercado'}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.gerentes-mercado.edit', $gerente->id)}}"
                        formaction="{{ route('admin.gerentes-mercado.destroy', $gerente->id) }}"
                        formconfirm="¿Está seguro de que desea eliminar este gerente de mercado?"
                        warning="¡Al eliminar este gerente de mercado eliminará todos sus registros relacionados a lo largo de la base de datos!"
                    />
                    <x-table-td-fd-routing
                        href="{{ route('admin.gerentes-mercado.mercados.index', $gerente->id) }}"
                    >
                        @if($gerente->mercado()->exists())
                            Mercado
                        @else
                            Asignar Mercado
                        @endif
                    </x-table-td-fd-routing>
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

    <x-index-table-pagination :variable="$gerentes"/>

</div>
