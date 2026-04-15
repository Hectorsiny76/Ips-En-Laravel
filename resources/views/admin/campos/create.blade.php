@extends('admin_layout.master')

@section('title', 'Editar campo '.$campo->numero)

@section('page-title', 'Editar campo '.$campo->numero)

@section('content')

    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Editar campo {{$campo->numero}}</h1>
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
        <form action="{{route('admin.campos.update', $campo->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="nombre" class="block text-lg font-medium text-gray-700 my-2">Número</label>

                <input
                    type="number"
                    name="numero"
                    placeholder="2"
                    value="{{old('numero', $campo->numero)}}"
                    min="1"
                    step="1"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    required>

                <label for="Gerente de mercado" class="block text-lg font-medium text-gray-700 my-2">Mercado</label>

                <input
                    type="text"
                    value="{{$campo->mercado->numero}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    readonly>

            </div>
            <div class="flex justify-center space-x-3 mt-8 pt-4 border-t border-gray-500">
                <a href="{{route('admin.mercados.campos.index', $campo->mercado->id)}}" class="px-6 py-2 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="px-6 py-2 text-lg font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Actualizar
                </button>
            </div>
        </form>
    </div>

@endsection
