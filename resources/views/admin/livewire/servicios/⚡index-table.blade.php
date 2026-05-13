<?php

use App\Models\Servicio;
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
        $query = Servicio::query();

        if($this->search !== ''){
            $query->whereRaw('LOWER(nombre) like ?', ['%'.strtolower($this->search).'%']);
        }

        $servicios = $query->latest()->paginate(10);

        $servicios->loadCount('clasificaciones');

        return view('admin.livewire.servicios.⚡index-table',[
            'servicios' => $servicios
        ]);
    }
};
?>

<div class="overflow-auto">

    <div class="mb-4">
        <x-input-form-label for="servicio">Buscar Servicio</x-input-form-label>

        <x-input-form
            type="text"
            name="servicio"
            placeholder="Soportar..."
            value=""
            wire:model.live.debounce="search"
            id="servicio"
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
            @foreach($servicios as $servicio)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$servicio->nombre}}
                    </td>
                    <td>
                        {{$servicio->clasificaciones_count}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.servicios.edit', $servicio->id)}}"
                        formaction="{{ route('admin.servicios.destroy', $servicio->id) }}"
                        formconfirm="¿Esta seguro de eliminar este servicio?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

    <div class="mt-4">
        {{ $servicios->links() }}
    </div>

</div>
