<?php

use App\Models\Categoria;
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
        $query = Categoria::query();

        if($this->search !== ''){
            $query->whereRaw('LOWER(nombre) like ?', ['%'.strtolower($this->search).'%']);
        }

        $categorias = $query->latest()->paginate(10);

        $categorias->loadCount('clasificaciones');

        return view('admin.livewire.categorias.⚡index-table',[
            'categorias' => $categorias
        ]);
    }
};
?>

<div class="overflow-auto">

    <div class="mb-4">
        <x-input-form-label for="categoria">Buscar Categoría</x-input-form-label>

        <x-input-form
            type="text"
            name="categoria"
            placeholder="Gestion de..."
            value=""
            wire:model.live.debounce="search"
        />

    </div>

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
            @foreach($categorias as $categoria)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$categoria->nombre}}
                    </td>
                    <td>
                        {{$categoria->clasificaciones_count}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.categorias.edit', $categoria->id)}}"
                        formaction="{{ route('admin.categorias.destroy', $categoria->id) }}"
                        formconfirm="¿Esta seguro de eliminar esta categoría?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

    <div class="mt-4">
        {{ $categorias->links() }}
    </div>

</div>
