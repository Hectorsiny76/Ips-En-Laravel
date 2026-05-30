@props(['ahref', 'formaction', 'formconfirm', 'warning' => ''])

<td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

    <a href="{{$ahref}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
        Editar
    </a>

    @can('delete-data-create-users')

        <form x-data="{ showModal: false }" action="{{ $formaction }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')

            <x-delete-modal :formconfirm="$formconfirm" :warning="$warning"/>

        </form>

    @endcan
</td>
