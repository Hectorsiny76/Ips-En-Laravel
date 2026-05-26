<?php

use App\Models\Mercado;
use App\Models\Campo;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {

    public $search = '';

    public Mercado $mercado;

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount($mercado)
    {
        $this->mercado = $mercado;
    }

    public function render()
    {
        $query = $this->mercado->campos();

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $campos = $query->latest()->paginate(10);

        $campos->load('mercado');

        return view('admin.livewire.campos.⚡index-table', [
            'campos' => $campos
        ]);
    }
};
?>

<div class="overflow-y-auto">

    <x-index-table-searchable-input
        title="Buscar campos"
        variable="search"
        />

    <x-index-div-table>

        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Numero
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Gerente
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>

        <x-index-div-table-tbody>

            @foreach($campos as $campo)
                <tr>
                    <td>
                        {{$campo->numero}}
                    </td>
                    <td>
                        {{$campo->campogerente?->nombre ?? 'No hay gerente asignado'}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.campos.edit', $campo->id)}}"
                        formaction="{{ route('admin.campos.destroy', $campo->id) }}"
                        formconfirm="¿Está seguro de que desea eliminar este campo?"
                        warning="¡Al eliminar este campo se eliminarán todos los datos relacionados!"
                    />
                    <x-table-td-fd-routing
                        href="{{ route('admin.campo.campo-gerente.index', $campo->id) }}"
                    >
                        @if($campo->campogerente()->exists())
                            Gerente de Campo
                        @else
                            Asignar gerente de campo
                        @endif
                    </x-table-td-fd-routing>
                </tr>
            @endforeach

        </x-index-div-table-tbody>

    </x-index-div-table>

    <x-index-table-pagination
        :variable="$campos"
        />

</div>
