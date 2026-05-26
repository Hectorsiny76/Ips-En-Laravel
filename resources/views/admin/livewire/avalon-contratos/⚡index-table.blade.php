<?php
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Avaloncontrato;

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
        $query = Avaloncontrato::with('establecimiento', 'estatus');

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $avaloncontratos = $query->latest()->paginate(10);

        return view('admin.livewire.avalon-contratos.⚡index-table', [
            'avaloncontratos' => $avaloncontratos
        ]);
    }
};
?>

<div class="overflow-y-auto">

    <x-index-table-searchable-input
        title="Buscar un contrato Ávalon"
        variable="search"
        />

    <x-index-table-pagination :variable="$avaloncontratos"/>

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Estación
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Numero
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Estatus
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($avaloncontratos as $avaloncontrato)
                <tr>
                    <td>
                        {{$avaloncontrato->establecimiento?->nombre ?? 'Sin asignar'}}
                    </td>
                    <td>
                        {{$avaloncontrato->numero}}
                    </td>
                    <td @class(['text-red-700'=>$avaloncontrato->estatus->id == 1, 'text-green-700'=>$avaloncontrato->estatus->id == 2])>
                        {{$avaloncontrato->estatus->nombre}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.avalon-contratos.edit', $avaloncontrato->id)}}"
                        formaction="{{route('admin.avalon-contratos.destroy', $avaloncontrato->id)}}"
                        formconfirm="¿Está seguro de que desea eliminar este contrato?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>
</div>
