<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Campogerente;

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

        $columnas = ['Nombre', 'Numero', 'Cajas/TPVS', 'IP'];

        $columnasDb = ['nombre', 'numero', 'cajas_tpvs', 'idred'];

        if(Str::slug($estTipo->nombre) == 'tienda'){
            $columnas[] = 'Ip Tidel';
            $columnasDb[] = 'tidelprograma.ip';

            $columnas[] = 'Formato de Tienda';
            $columnasDb[] = 'tiendaformato.nombre';

            $columnas[] = 'Cluster';
            $columnasDb[] = 'cluster.nombre';
        }
        else if(Str::slug($estTipo->nombre) == 'estacion'){
            $columnas[] = 'CDC';
            $columnasDb[] = 'centrodecostos';

            $columnas[] = 'Tel';
            $columnasDb[] = 'tel';

            $columnas[] = 'Correo';
            $columnasDb[] = 'correo';

            $columnas[] = 'Contrato Ávalon';
            $columnasDb[] = 'avaloncontrato.numero';
        }

        // Aquí se pueden agregar más if o en su caso un match o si lo ven necesario agregar en una clase de servicio los valores de cada columna de cada tipo de establecimiento

        $establecimientos = $query->latest()->paginate(10);

        $establecimientos->load(['cluster', 'tidelprograma', 'tiendaformato', 'avaloncontrato']);

        return view('admin.livewire.establecimientos.⚡index-table', [
            'establecimientos' => $establecimientos,
            'columnas' => $columnas,
            'columnasDb' => $columnasDb,
        ]);
    }
};
?>

<div class="overflow-y-auto">

    <x-index-table-searchable-input
        title="Buscar Establecimientos"
        variable="search"
        />

    <x-index-div-table>
        <x-index-div-table-thead>
            @foreach($columnas as $columna)
                <x-index-div-table-thead-th-column>{{$columna}}</x-index-div-table-thead-th-column>
            @endforeach
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($establecimientos as $establecimiento)
                <tr>
                    @foreach($columnasDb as $columnaDb)
                        <td>{{data_get($establecimiento, $columnaDb) ?? 'N/A'}}</td>
                    @endforeach
                    <x-table-td-actions
                        ahref="{{route('admin.establecimientos.edit', $establecimiento->id)}}"
                        formaction="{{route('admin.establecimientos.destroy', $establecimiento->id)}}"
                        formconfirm="¿Esta seguro de que desea eliminar este establecimiento?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

    <x-index-table-pagination :variable="$establecimientos"/>

</div>
