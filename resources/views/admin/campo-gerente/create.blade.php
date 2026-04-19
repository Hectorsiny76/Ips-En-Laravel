@extends('admin_layout.master')

@section('title', 'Crear un gerente para el Campo '.$campo->numero)

@section('page-title', 'Crear un gerente para el Campo '.$campo->numero)

@section('content')

    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Crear gerente para el Campo {{$campo->numero}}</h1>
    </div>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.campo.campo-gerente.store', $campo->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nombre" class="block text-lg font-medium text-gray-700 my-2">Número</label>

                <input
                    type="text"
                    name="nombre"
                    placeholder="Mr. Smith"
                    value="{{old('nombre')}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    required>

                <label for="tel" class="block text-lg font-medium text-gray-700 my-2">Teléfono</label>

                <input
                    type="tel"
                    name="tel"
                    placeholder="8181818181"
                    value="{{old('tel')}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    required>

                <label for="correo" class="block text-lg font-medium text-gray-700 my-2">Correo</label>

                <input
                    type="email"
                    name="correo"
                    placeholder="example@example.com"
                    value="{{old('correo')}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    required>

                <label for="campo" class="block text-lg font-medium text-gray-700 my-2">Campo</label>

                <input
                    name="campo"
                    type="number"
                    value="{{$campo->numero}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    readonly>

            </div>
            <div class="flex justify-center space-x-3 mt-8 pt-4 border-t border-gray-500">
                <a href="{{route('admin.mercados.campos.index', $campo->id)}}" class="px-6 py-2 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="px-6 py-2 text-lg font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Crear
                </button>
            </div>
        </form>
    </div>

@endsection

