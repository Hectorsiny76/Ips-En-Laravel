@extends('admin_layout.master')

@section('title', 'Tipos de establecimientos')

@section('page-title', 'Tipos de establecimientos')

@section('content')
    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Estos son los tipos de establecimientos actuales</h1>
        <a href="{{ route('admin.estados.index')}}" class="bg-indigo-300  px-4 py-2 rounded">
            Agregar nuevo tipo de establecimiento
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
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($estTipos as $estTipo)
                <tr>
                    @foreach($columnasDb as $columnaDb)
                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                            {{data_get($estTipo, $columnaDb) ?? 'N/A'}}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
