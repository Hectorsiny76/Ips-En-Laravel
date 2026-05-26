@props(['ahref', 'formaction', 'formconfirm', 'warning' => ''])

<td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

    <a href="{{$ahref}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
        Editar
    </a>

    <form x-data="{ showModal: false }" action="{{ $formaction }}" method="POST" class="inline-block">
        @csrf
        @method('DELETE')

        <button
            type="button"
            @click="showModal = true"
            class="text-red-600 hover:text-red-900">
            Eliminar
        </button>

        <div
            x-show="showModal"
            x-cloak
            class="z-50 fixed inset-0 flex items-center justify-center bg-black/50"
        >
            <div
                @click.away="showModal = false"
                class="bg-white p-6 rounded"
            >
                <h2 class="text-center text-lg font-bold">
                    {{$formconfirm}}
                </h2>

                @if($warning != '')
                    <h1 class="text-center text-red-800 font-bold py-2 underline">{{$warning}}</h1>
                @endif

                <div class="m-4 flex items-center justify-around">
                    <button
                        type="button"
                        @click="showModal = false"
                        class="bg-gray-400 hover:bg-gray-300 px-4 py-2"
                    >
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="bg-red-600 border-2 border-transparent text-white px-4 py-2 transition-all duration-200 hover:border-2 hover:border-black hover:border-double hover:rounded-md hover:bg-red-950"
                    >
                        Eliminar
                    </button>
                </div>
            </div>
        </div>

    </form>
</td>
