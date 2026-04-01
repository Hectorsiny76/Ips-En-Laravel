@extends('admin_layout.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Bienvenido</h1>

    <p class="mb-4">Estos son los datos actuales</p>

    <ul class="space-y-4">
        <li class="p-4 bg-white shadow rounded-lg">
            <strong>Establecimientos totales</strong>
            <span>
                    ({{$establecimientos}})
            </span>
        </li>

        @forelse($establecimientoTipos as $establecimientoTipo)
            <li class="p-4 bg-white shadow rounded-lg">
                <strong>{{$establecimientoTipo->nombre}}</strong>
                <span>
                    ({{$establecimientoTipo->establecimientos_count}})
                </span>
            </li>

        @empty

            <div class="p-6 bg-yellow-50 text-shadow-yellow-700 border border-b-yellow-200 rounded-lg text-center">
                <p>No hay establecimientos aún. Agrega uno</p>
            </div>

        @endforelse

        <li class="p-4 bg-white shadow rounded-lg">
            <strong>Programas piloto</strong>
            <span>
                    ({{$programasPiloto}})
            </span>
        </li>

        <li class="p-4 bg-white shadow rounded-lg">
            <strong>Establecimientos en piloto</strong>
            <span>
                    ({{$pilotoEstablecimientos}})
            </span>
        </li>
    </ul>
@endsection
