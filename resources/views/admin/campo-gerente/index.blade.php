@extends('admin_layout.master')

@section('title', 'Gerente Campo ' . $campo->campogerente->nombre)

@section('page-title', 'Gerente Campo ' . $campo->campogerente->nombre)

@section('content')

    <x-nav-ol-first href="{{route('admin.estados.index')}}" nombre="Estados">
        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                <a href="{{ route('admin.estados.gerentes-mercado.index', $campo->mercado->mercadogerente->estado->id) }}" class="hover:text-indigo-600 transition-colors">
                    Gerentes de mercado de {{ $campo->mercado->mercadogerente->estado->nombre }}
                </a>
            </div>
        </li>

        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                <a href="{{ route('admin.gerentes-mercado.mercados.index', $campo->mercado->mercadogerente->id) }}" class="hover:text-indigo-600 transition-colors">
                    Mercado {{ $campo->mercado->numero }} ({{$campo->mercado->establecimientotipo->nombre}})
                </a>
            </div>
        </li>

        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                <a href="{{ route('admin.mercados.campos.index', $campo->mercado->id) }}" class="hover:text-indigo-600 transition-colors">
                    Campos del mercado {{ $campo->mercado->numero }}
                </a>
            </div>
        </li>
    </x-nav-ol-first>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 relative">
            <thead class="bg-gray-50">
            <tr>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Nombre
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Teléfono
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Correo
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Campo
                </th>
                <x-index-div-table-thead-th-actions-column/>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <tr>
                <td>
                    {{$campo->campogerente->nombre}}
                </td>
                <td>
                    {{$campo->campogerente->tel}}
                </td>
                <td>
                    {{$campo->campogerente->correo}}
                </td>
                <td>
                    {{$campo->numero}}
                </td>
                <x-table-td-actions
                    ahref="{{ route('admin.campo-gerente.edit', $campo->campogerente->id) }}"
                    formaction="{{ route('admin.campo-gerente.destroy', $campo->campogerente->id) }}"
                    formconfirm="¿Está seguro de eliminar este gerente de campo?"
                    warning="¡Al eliminar este gerente de campo se eliminarán todos sus establecimientos relacionados!"
                    />
                <x-table-td-fd-routing href="{{ route('admin.campo-gerente.establecimientos.index', $campo->campogerente->id) }}">
                    Establecimientos
                </x-table-td-fd-routing>
            </tr>
            </tbody>
        </table>
    </div>

@endsection

