@props(['formconfirm', 'warning'])

<button
    type="button"
    @click="showModal = true"
    class="dark:text-red-500 dark:hover:text-red-400 text-red-600 hover:text-red-900">
    Eliminar
</button>

<div
    x-show="showModal"
    x-cloak
    class="z-50 fixed inset-0 flex items-center justify-center bg-black/50"
>
    <div
        @click.away="showModal = false"
        class="bg-white dark:bg-gray-800 p-6 rounded"
    >
        <h2 class="text-center dark:text-gray-400 text-lg font-bold">
            {{$formconfirm}}
        </h2>

        @if($warning != '')
            <h1 class="text-center dark:text-red-600 text-red-800 font-bold py-2 underline">{{$warning}}</h1>
        @endif

        <div class="m-4 flex items-center justify-around">
            <button
                type="button"
                @click="showModal = false"
                class="bg-gray-400 dark:text-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700 hover:bg-gray-300 px-4 py-2"
            >
                Cancelar
            </button>

            <button
                type="submit"
                class="bg-red-600 dark:bg-red-800 dark:hover:bg-red-700 dark:hover:border-gray-300 border-2 hover:border-2 border-transparent text-white px-4 py-2 transition-all duration-200  hover:border-black hover:rounded-md hover:bg-red-950"
            >
                Eliminar
            </button>
        </div>
    </div>
</div>
