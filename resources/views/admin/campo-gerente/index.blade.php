@extends('admin_layout.master')

@section('title', 'Gerente Campo ' . $campo->campogerente->nombre)

@section('page-title', 'Gerente Campo ' . $campo->campogerente->nombre)

@section('content')

    <nav class="flex text-sm text-gray-500 font-medium mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">

            <li class="inline-flex items-center">
                <a href="{{ route('admin.estados.index') }}" class="hover:text-indigo-600 transition-colors">
                    Estados
                </a>
            </li>

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
                        Mercado {{ $campo->mercado->numero }}
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

        </ol>
    </nav>

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
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm text-gray-500 uppercase">
                    Acciones
                </th>
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
                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

                    <a href="{{route('admin.campo-gerente.edit', $campo->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                        Editar
                    </a>

                    <form action="{{ route('admin.campo-gerente.destroy', $campo->campogerente->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de que desea eliminar este mercado?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-red-600 hover:text-red-900">
                            Eliminar
                        </button>
                    </form>

                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.mercados.campos.index', $campo->mercado->id) }}" class="text-blue-600 hover:text-blue-900 mr-4 font-bold">
                        Campos
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection

