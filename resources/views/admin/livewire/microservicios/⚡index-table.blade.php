<?php

use App\Models\Microservicio;
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
        $query = Microservicio::query();

        if($this->search !== ''){
            $query->whereRaw('LOWER(nombre) like ?', ['%'.strtolower($this->search).'%']);
        }

        $microservicios = $query->latest()->paginate(10);

        $microservicios->loadCount('clasificaciones');

        return view('admin.livewire.microservicios.⚡index-table',[
            'microservicios' => $microservicios
        ]);
    }
};
?>

<div class="overflow-auto">

    <div class="mb-4">
        <x-input-form-label for="microservicio">Buscar Microservicio</x-input-form-label>

        <x-input-form
            type="text"
            name="microservicio"
            placeholder="Reparar DB..."
            value=""
            wire:model.live.debounce="search"
            id="microservicio"
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
            @foreach($microservicios as $microservicio)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$microservicio->nombre}}
                    </td>
                    <td>
                        {{$microservicio->clasificaciones_count}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.microservicios.edit', $microservicio->id)}}"
                        formaction="{{ route('admin.microservicios.destroy', $microservicio->id) }}"
                        formconfirm="¿Esta seguro de eliminar este microservicio?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

    <div class="mt-4">
        {{ $microservicios->links() }}
    </div>

</div>
