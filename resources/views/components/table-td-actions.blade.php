@props(['ahref', 'formaction', 'formconfirm'])

<td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

    <a href="{{$ahref}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
        Editar
    </a>

    <form action="{{ $formaction }}" method="POST" class="inline-block" onsubmit="return confirm('{{$formconfirm}}');">
        @csrf
        @method('DELETE')

        <button type="submit" class="text-red-600 hover:text-red-900">
            Eliminar
        </button>
    </form>
</td>
