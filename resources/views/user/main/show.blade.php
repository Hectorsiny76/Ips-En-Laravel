@extends('main_layout.main')

@section('title', 'Requerimientos')
@section('contenido')

    <div class="bg-white gap-6 p-4 flex-col h-auto">
        <form action="{{ route('user.main.show') }}" method="POST" class="grid grid-cols-12 gap-4">
            @csrf
            <div class="flex-col col-span-5">
                <input type="text" name="nombre" placeholder="Nombre" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="flex-col col-span-5">
                <input type="text" name="numero" placeholder="Numero" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="flex flex-col col-span-2">
                <button type="submit" class="bg-green-800 text-white p-2 rounded w-full">Buscar</button>
            </div>

            @if($est)
                <div class="col-span-12 mt-4">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr style="background-color: oklch(44.8% 0.119 151.328); color: white;">
                                <th class="border border-gray-300 px-4 py-2">Numero</th>
                                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                                <th class="border border-gray-300 px-4 py-2">CC</th>
                                <th class="border border-gray-300 px-4 py-2">IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: oklch(84.5% 0.143 164.978 / 0.3);">
                                <td class="border border-gray-300 px-4 py-2">{{$est->numero ?? '—'}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$est->nombre ?? '—'}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$est->centrodecostos ?? '—'}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$est->idred ?? '—'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-span-12 mt-4">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr style="background-color: oklch(44.8% 0.119 151.328); color: white;">
                                <th class="border border-gray-300 px-4 py-2">Gte Campo</th>
                                <th class="border border-gray-300 px-4 py-2">Campo</th>
                                <th class="border border-gray-300 px-4 py-2">Mercado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: oklch(84.5% 0.143 164.978 / 0.3);">
                                <td class="border border-gray-300 px-4 py-2">{{$est->campogerente->nombre ?? '—'}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$est->campo->numero ?? '—'}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$est->mercado->numero ?? '—'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-span-12 mt-4">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr style="background-color: oklch(44.8% 0.119 151.328); color: white;">
                                <th class="border border-gray-300 px-4 py-2">Gerente Mercado</th>
                                <th class="border border-gray-300 px-4 py-2">Estado</th>
                                <th class="border border-gray-300 px-4 py-2">Formato Tienda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: oklch(84.5% 0.143 164.978 / 0.3);">
                                <td class="border border-gray-300 px-4 py-2">{{$est->mercadogerente->nombre ?? '—'}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$est->estado->nombre ?? '—'}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$est->tiendaformato->nombre ?? '—'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="col-span-12 mt-8 text-center text-gray-500">
                    No se encontraron resultados para la búsqueda.
                </div>
            @endif
        </form>
    </div>

@endsection