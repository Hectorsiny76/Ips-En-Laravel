<?php

use App\Models\Subcategoria;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    public $search = '';

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Subcategoria::query();

        if($this->search !== ''){
            $query->whereRaw('LOWER(nombre) like ?', ['%'.strtolower($this->search).'%']);
        }

        $subcategorias = $query->latest()->paginate(10);

        $subcategorias->loadCount('clasificaciones');

        return view('admin.livewire.subcategorias.⚡index-table',[
            'subcategorias' => $subcategorias
        ]);
    }
};
?>

<div class="overflow-auto">

    <x-index-table-searchable-input
        title="Buscar Subcategoría"
        variable="search"
        />

    <x-index-table-pagination :variable="$subcategorias"/>

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                No
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Nombre
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Clasificaciones relacionadas
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($subcategorias as $subcategoria)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$subcategoria->nombre}}
                    </td>
                    <td>
                        {{$subcategoria->clasificaciones_count}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.subcategorias.edit', $subcategoria->id)}}"
                        formaction="{{ route('admin.subcategorias.destroy', $subcategoria->id) }}"
                        formconfirm="¿Esta seguro de eliminar esta subcategoría?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

</div>
