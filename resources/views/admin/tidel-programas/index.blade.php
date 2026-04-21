@extends('admin_layout.master')

@section('title', 'Lista de migraciones tidel')

@section('page-title', 'Lista de migraciones tidel')

@section('content')

    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Estos son las migraciones hechas a tidel</h1>
        <a href="{{ route('admin.tidel-programas.create')}}" class="bg-indigo-300  px-4 py-2 rounded">
            Agregar Migración a Tidel
        </a>
    </div>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 relative">
            <thead class="bg-gray-50">
            <tr>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Ip
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Fecha Migración
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Tienda
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm text-gray-500 uppercase">
                    Acciones
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($tidelprogramas as $tidelprograma)
                <tr>
                    <td>
                        {{$tidelprograma->ip}}
                    </td>
                    <td>
                        {{$tidelprograma->fechamigracion}}
                    </td>
                    <td>
                        {{$tidelprograma->establecimiento?->nombre ?? 'No hay establecimiento asignado'}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

                        <a href="{{route('admin.tidel-programas.edit', $tidelprograma->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                            Editar
                        </a>

                        <form action="{{ route('admin.tidel-programas.destroy', $tidelprograma->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de que desea eliminar este estado?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
