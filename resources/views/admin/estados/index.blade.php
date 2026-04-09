@extends('admin_layout.master')

@section('title', 'Estados')

@section('page-title', 'Estados')

@section('content')
    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Estos son los estados actuales</h1>
        <a href="{{ route('admin.estados.create')}}" class="bg-indigo-300  px-4 py-2 rounded">
            Agregar Estado
        </a>
    </div>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 relative">
            <thead class="bg-gray-50">
            <tr>
                @foreach($columnas as $columna)
                    <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                        {{$columna}}
                    </th>
                @endforeach
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm text-gray-500 uppercase">
                    Acciones
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($estados as $estado)
                <tr>
                    @foreach($columnasDb as $columnaDb)
                        <td>
                            {{data_get($estado, $columnaDb) ?? 'N/A'}}
                        </td>
                    @endforeach
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

                        <a href="{{route('admin.estados.edit', $estado->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                            Editar
                        </a>

                        <form action="{{ route('admin.estados.destroy', $estado->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de que desea eliminar este estado?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
                        </form>

                    </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                            <a href="{{ route('admin.estados.gerentes-mercado.index', $estado->id) }}" class="text-blue-600 hover:text-blue-900 mr-4 font-bold">
                                Gerentes de Mercado
                            </a>

                        </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
