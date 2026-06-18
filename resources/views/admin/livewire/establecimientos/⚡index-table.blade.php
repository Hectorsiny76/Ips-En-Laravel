<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Campogerente;
use App\Services\SucursalService;

new class extends Component {
    public $search = '';

    public Campogerente $campogerente;

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount($campogerente)
    {
        $this->campogerente = $campogerente;

    }

    public function render()
    {
        $query = $this->campogerente->establecimientos();

        if ($this->search !== '') {

            $this->search = strtolower($this->search);

            $query->search($this->search);
        }

        $estTipo = $this->campogerente->establecimientotipo;

        $columnas = SucursalService::columnasAdmin($estTipo);

        $establecimientos = $query->latest()->paginate(10);

        $establecimientos->load(['cluster', 'tidelprograma', 'tiendaformato', 'avaloncontrato']);

        return view('admin.livewire.establecimientos.⚡index-table', [
            'establecimientos' => $establecimientos,
            'columnas' => $columnas,
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input
        title="Buscar Establecimientos"
        variable="search"
        />

    <x-index-table-pagination :variable="$establecimientos"/>

    <x-livewire-content-div>
        <x-index-div-table>
            <x-index-div-table-thead>
                @foreach($columnas['th'] as $columna)
                    <x-index-div-table-thead-th-column>{{$columna}}</x-index-div-table-thead-th-column>
                @endforeach
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
                @foreach($establecimientos as $establecimiento)
                    <tr>
                        @foreach($columnas['tb'] as $columnaDb)
                            <td>{{data_get($establecimiento, $columnaDb) ?? 'N/A'}}</td>
                        @endforeach
                        <x-table-td-actions
                            ahref="{{route('admin.establecimientos.edit', $establecimiento->id)}}"
                            formaction="{{route('admin.establecimientos.destroy', $establecimiento->id)}}"
                            formconfirm="¿Esta seguro de que desea eliminar este establecimiento?"
                            warning="¡Al eliminarse no se podrá recuperar!"
                        />
                    </tr>
                @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
