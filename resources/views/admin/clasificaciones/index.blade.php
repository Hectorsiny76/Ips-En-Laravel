@extends('admin_layout.master')

@section('title', 'Clasificaciones')

@section('page-title', 'Clasificaciones')

@section('content')

    <div x-data="{showOption : false}" class="flex justify-between py-2">

        <h1 class="dark:text-white text-xl font-semibold py-2 flex-shrink-0">Estos son las clasificaciones actuales</h1>
        <button type="button" @click="showOption = true" class="bg-indigo-300 dark:bg-indigo-900/50 dark:hover:bg-indigo-700/50 dark:focus:border dark:focus:border-gray-400 border border-transparent dark:text-gray-300 px-4 py-2 rounded  hover:text-indigo-900 mr-4">Agregar una nueva clasificación</button>

        <div
            x-show="showOption"
            x-cloak
            class="z-50 fixed inset-0 flex items-center justify-center bg-black/50"
        >
            <div
                @click.away="showOption = false"
                class="bg-white p-6 rounded"
            >
                <h2 class="text-center text-lg font-bold">
                    ¿Cómo desea crear una clasificación nueva?
                </h2>

                <div class="m-4 flex items-center justify-around">

                    <a href="{{route('admin.clasificaciones.create')}}" class="bg-indigo-200  px-4 py-2 rounded text-indigo-600 hover:text-indigo-900 mr-4">
                        Categorias ya existentes
                    </a>

                    <a href="{{route('admin.clasificaciones.create-from-zero')}}" class="bg-indigo-200  px-4 py-2 rounded text-indigo-600 hover:text-indigo-900 mr-4">
                        Desde Cero
                    </a>
                </div>

                <div class="flex justify-center items-center">
                    <button
                        type="button"
                        @click="showOption = false"
                        class="bg-gray-400 hover:bg-gray-300 px-4 py-2"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>

    </div>

    <livewire:admin::livewire.clasificaciones.index-table/>

@endsection

