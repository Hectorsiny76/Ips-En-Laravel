@extends('main_layout.main')

@section('title', 'Requerimientos')
@section('contenido')

    <div class="bg-white gap-6 p-4 flex-col h-auto">
        <livewire:user::livewire.buscar-est />

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
                        <tr style="background-color: oklch(92.5% 0.084 155.995);">
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
                        <tr style="background-color: oklch(92.5% 0.084 155.995);">
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
                        <tr style="background-color: oklch(92.5% 0.084 155.995);">
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

    </div>

@endsection