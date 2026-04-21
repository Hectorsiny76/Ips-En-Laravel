@extends('admin_layout.master')

@section('title', 'Lista de formatos de tienda')

@section('page-title', 'Lista de formatos de tienda')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los formatos de tienda existentes"
        url="{{route('admin.tienda-formatos.create')}}"
        button="Agregar un nuevo formato de tienda"
    />

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 relative">
            <thead class="bg-gray-50">
            <tr>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Nombre
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Tiendas Relacionadas
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm text-gray-500 uppercase">
                    Acciones
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($tiendaformatos as $tiendaformato)
                <tr>
                    <td>
                        {{$tiendaformato->nombre}}
                    </td>
                    <td>
                        {{$tiendaformato->establecimientos_count}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

                        <a href="{{route('admin.tienda-formatos.edit', $tiendaformato->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                            Editar
                        </a>

                        <form action="{{ route('admin.tienda-formatos.destroy', $tiendaformato->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de que desea eliminar este estado?');">
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

