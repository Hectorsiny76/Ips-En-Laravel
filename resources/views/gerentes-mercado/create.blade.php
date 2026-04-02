@extends('admin_layout.master')

@section('title', 'Gerentes de mercado de ' . $estado->nombre)

@section('page-title', 'Gerentes de mercado de ' . $estado->nombre)

@section('content')

    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Agrega un gerente de mercado nuevo del estado de {{$estado->nombre}}</h1>
    </div>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <form action="{{route('estados.gerentes-mercado.store', $estado->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nombre" class="block text-lg font-medium text-gray-700 my-2">Nombre</label>

                <input
                    type="text"
                    name="nombre"
                    placeholder="Mr. Smith"
                    value="{{old('nombre')}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700
                    @error('nombre') border-red-500 text-red-900 @else border-gray-300  @enderror"
                    required>

                @error('name')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center space-x-3 mt-8 pt-4 border-t border-gray-500">
                <a href="{{route('estados.gerentes-mercado.index', $estado->id)}}" class="px-6 py-2 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
