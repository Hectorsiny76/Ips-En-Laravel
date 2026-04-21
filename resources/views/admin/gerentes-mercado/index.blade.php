@extends('admin_layout.master')

@section('title', 'Gerentes de mercado de '.$estado->nombre)

@section('page-title', 'Gerentes de mercado de '.$estado->nombre)

@section('content')
    <x-nav-ol-estado/>
    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Estos son los gerentes de mercado de {{$estado->nombre}}</h1>
        <a href="{{ route('admin.estados.gerentes-mercado.create', $estado->id)}}" class="bg-indigo-300  px-4 py-2 rounded">
            Agregar Gerente de Mercado
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
            @foreach($mercadoGerentes as $mercadoGerente)
                <tr>
                    @foreach($columnasDb as $columnaDb)
                        <td>
                            {{data_get($mercadoGerente, $columnaDb) ?? 'N/A'}}
                        </td>
                    @endforeach
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

                        <a href="{{route('admin.gerentes-mercado.edit', $mercadoGerente->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                            Editar
                        </a>

                        <form action="{{ route('admin.gerentes-mercado.destroy', $mercadoGerente->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de que desea eliminar este gerente de mercado?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
                        </form>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.gerentes-mercado.mercados.index', $mercadoGerente->id) }}" class="text-blue-600 hover:text-blue-900 mr-4 font-bold">
                            @if($mercadoGerente->mercado()->exists())
                                Mercado
                            @else
                                Asignar Mercado
                            @endif

                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
