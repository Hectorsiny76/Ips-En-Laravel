<?php

use App\Enums\UserRole;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

new class extends Component {
    public $search = '';

    use WithPagination;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $currentUser = auth()->user();

        $query = User::query();

        if (!$currentUser->isMasterAdmin()) {
            $query->where('role', '!=', UserRole::Master);
        }

        if ($this->search !== '') {
            $query->search($this->search);
        }

        $users = $query->latest()->paginate(10);

        return view('admin.livewire.users.⚡index-table', [
            'users' => $users
        ]);
    }
};
?>

<x-livewire-parent-div>

    <x-index-table-searchable-input
        variable="search"
        title="Buscar un programa tidel"
    />

    <x-index-table-pagination
        :variable="$users"
    />

    <x-livewire-content-div>
        <x-index-div-table>

            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    No
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Nombre
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Admin
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>

            <x-index-div-table-tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$user->name ?? 'No hay establecimiento asignado'}}
                        </td>
                        <td>
                            {{$user->role->name}}
                        </td>
                        <td>
                            @can('delete-admins', $user)
                                <form x-data="{ showModal: false }" action="{{route('admin.users.destroy', $user->id)}}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <x-delete-modal formconfirm="¿Está seguro de querer eliminar este admin?"
                                                    warning="¡Esta acción no se podrá deshacer!"/>

                                </form>

                            @else

                                <span class="text-gray-400">Acceso Restringido</span>

                            @endcan
                        </td>
                    </tr>
                @endforeach
            </x-index-div-table-tbody>

        </x-index-div-table>
    </x-livewire-content-div>

</x-livewire-parent-div>
