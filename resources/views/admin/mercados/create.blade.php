@extends('admin_layout.master')

@section('title', 'Crear Mercado')

@section('page-title', 'Crear un Nuevo Mercado para '.$mercadoGerente->nombre)

@section('content')

    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Agrega un mercado nuevo</h1>
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
        <form action="{{route('admin.gerentes-mercado.mercados.store', $mercadoGerente->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nombre" class="block text-lg font-medium text-gray-700 my-2">Número</label>

                <input
                    type="number"
                    name="numero"
                    placeholder="601"
                    value="{{old('numero')}}"
                    min="1"
                    step="1"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700
                    @error('numero') border-red-500 text-red-900 @else border-gray-300  @enderror"
                    required>

                @error('name')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                @enderror

                <label for="Gerente de mercado" class="block text-lg font-medium text-gray-700 my-2">Gerente de Mercado</label>

                <input
                    type="text"
                    value="{{$mercadoGerente->nombre}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700
                    @error('numero') border-red-500 text-red-900 @else border-gray-300  @enderror"
                    readonly>

                <label for="establecimientotipo_id" class="block text-lg font-medium text-gray-700 my-2">Tipo de establecimiento</label>

                <select name="establecimientotipo_id" required>
                    @foreach($estTipos as $estTipo)
                        <option value="{{$estTipo->id}}">{{$estTipo->nombre}}</option>
                    @endforeach
                </select>

                @error('name')
                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center space-x-3 mt-8 pt-4 border-t border-gray-500">
                <a href="{{route('admin.estados.gerentes-mercado.index', $mercadoGerente->estado->id)}}" class="px-6 py-2 text-lg font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
