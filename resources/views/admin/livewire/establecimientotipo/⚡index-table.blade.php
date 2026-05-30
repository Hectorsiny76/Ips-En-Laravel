<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Establecimiento;
use App\Models\Establecimientotipo;

new class extends Component
{
    public $search = '';

    public Establecimientotipo $estTipo;

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount($estTipo)
    {
        $this->estTipo = $estTipo;
    }

    public function render()
    {

        $estsIds = $this->estTipo->establecimientos()->pluck('establecimientos.id');

        $query = Establecimiento::with(['avaloncontrato', 'campogerente', 'cluster', 'tidelprograma', 'tiendaformato'])->whereIn('id', $estsIds);

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $establecimientos = $query->latest()->paginate(10);

        $columnas = ['Nombre', 'Numero', 'Cajas/TPVS', 'Id de red', 'Gerente de Campo'];

        $columnasDb = ['nombre', 'numero', 'cajas_tpvs', 'idred', 'campogerente.nombre'];

        if(Str::slug($this->estTipo->nombre) == 'tienda'){
            $columnas[] = 'Ip Tidel';
            $columnasDb[] = 'tidelprograma.ip';

            $columnas[] = 'Formato de Tienda';
            $columnasDb[] = 'tiendaformato.nombre';

            $columnas[] = 'Cluster';
            $columnasDb[] = 'cluster.nombre';
        }
        else if(Str::slug($this->estTipo->nombre) == 'estacion'){
            $columnas[] = 'CDC';
            $columnasDb[] = 'centrodecostos';

            $columnas[] = 'Tel';
            $columnasDb[] = 'tel';

            $columnas[] = 'Correo';
            $columnasDb[] = 'correo';

            $columnas[] = 'Contrato Ávalon';
            $columnasDb[] = 'avaloncontrato.numero';
        }

        return view('admin.livewire.establecimientotipo.⚡index-table', [
            'establecimientos' => $establecimientos,
            'columnasDb' => $columnasDb,
            'columnas' => $columnas
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input
        title="Buscar un@ {{$estTipo->nombre}}"
        variable="search"
        />

    <x-index-table-pagination :variable="$establecimientos"/>

    <x-livewire-content-div>
        <x-index-div-table>

            <x-index-div-table-thead>
                @foreach($columnas as $columna)
                    <x-index-div-table-thead-th-column>
                        {{$columna}}
                    </x-index-div-table-thead-th-column>
                @endforeach
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>

            <x-index-div-table-tbody>
                @foreach($establecimientos as $establecimiento)
                    <tr>
                        @foreach($columnasDb as $columnaDb)
                            <td>
                                {{data_get($establecimiento, $columnaDb) ?? 'N/A'}}
                            </td>
                        @endforeach
                        <x-table-td-actions
                            ahref="{{route('admin.establecimientos.edit', $establecimiento->id)}}"
                            formaction="{{route('admin.establecimientos.destroy', $establecimiento->id)}}"
                            formconfirm="¿Está seguro de que desea eliminar esta {{$establecimiento->nombre}}?"
                            warning="¡Esta acción no se podrá deshacer!"
                        />
                    </tr>
                @endforeach
            </x-index-div-table-tbody>

        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
