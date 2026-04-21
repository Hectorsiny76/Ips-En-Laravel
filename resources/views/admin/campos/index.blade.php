@extends('admin_layout.master')

@section('title', 'Campos del mercado '.$mercado->numero)

@section('page-title', 'Campos del mercado '.$mercado->numero)

@section('content')

    <x-nav-ol-estado>
        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                <a href="{{ route('admin.estados.gerentes-mercado.index', $mercado->mercadogerente->estado) }}" class="hover:text-indigo-600 transition-colors">
                    Gerentes de mercado de {{ $mercado->mercadogerente->estado->nombre }}
                </a>
            </div>
        </li>

        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                <a href="{{ route('admin.gerentes-mercado.mercados.index', $mercado->mercadogerente->id) }}" class="hover:text-indigo-600 transition-colors">
                    Mercado {{ $mercado->numero }} ({{$mercado->establecimientotipo->nombre}})
                </a>
            </div>
        </li>
    </x-nav-ol-estado>
    <div class="flex justify-between">
        <h1 class="text-xl font-semibold mb-4 flex-shrink-0">Estos son los campos del mercado {{$mercado->numero}}</h1>
        <a href="{{ route('admin.mercados.campos.create', $mercado)}}" class="bg-indigo-300  px-4 py-2 rounded">
            Agregar Campo
        </a>
    </div>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 relative">
            <thead class="bg-gray-50">
            <tr>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Numero
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm">
                    Gerente
                </th>
                <th class="sticky top-0 z-10 px-1 py-3 text-left bg-gray-50 shadow-sm text-gray-500 uppercase">
                    Acciones
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($campos as $campo)
                <tr>
                    <td>
                        {{$campo->numero}}
                    </td>
                    <td>
                        {{$campo->campogerente?->nombre ?? 'No hay gerente asignado'}}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">

                        <a href="{{route('admin.campos.edit', $campo->id)}}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                            Editar
                        </a>

                        <form action="{{ route('admin.campos.destroy', $campo->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de que desea eliminar este estado?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
                        </form>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                        <a href="{{ route('admin.campo.campo-gerente.index', $campo->id) }}" class="text-blue-600 hover:text-blue-900 mr-4 font-bold">
                            @if($campo->campogerente()->exists())
                                Gerente de Campo
                            @else
                                Asignar gerente de campo
                            @endif
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
