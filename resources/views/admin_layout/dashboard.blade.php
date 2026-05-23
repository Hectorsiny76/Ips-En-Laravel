@extends('admin_layout.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')
    <div  class="w-full overflow-auto">
        <h1 class="text-xl font-semibold mb-4">Bienvenido</h1>

        <p class="mb-4">Estos son los datos actuales</p>

        <ul class="space-y-4 mb-4">
            <li class="p-4 bg-white shadow rounded-lg">
                <strong>Establecimientos totales</strong>
                <span>
                    ({{$establecimientos}})
            </span>
            </li>

            @forelse($establecimientoTipos as $establecimientoTipo)
                <li class="p-4 bg-white shadow rounded-lg">
                    <a href="{{route('admin.establecimientotipo.show', $establecimientoTipo->id)}}"
                       class="hover:text-blue-900">
                        <strong>{{$establecimientoTipo->nombre}}</strong>
                        <span>
                    ({{$establecimientoTipo->establecimientos_count}})
                </span>
                    </a>
                </li>

            @empty

                <div class="p-6 bg-yellow-50 text-shadow-yellow-700 border border-b-yellow-200 rounded-lg text-center">
                    <a href="{{route('admin.establecimientotipo.create')}}" class="hover:text-blue-900">
                        <p>No hay establecimientos aún. Agrega uno</p>
                    </a>
                </div>

            @endforelse

            <li class="p-4 bg-white shadow rounded-lg">
                <a href="{{route('admin.programas-piloto.index')}}" class="hover:text-blue-900">
                    <strong>Programas piloto</strong>

                    <span>
                    ({{$programasPiloto}})
                </span>
                </a>
            </li>
        </ul>

        <div class="w-full">
            <div class="w-full p-4 border-2 rounded-md border-double">

                <livewire:admin::livewire.navbar.navbar-manager/>

            </div>

            <div class="w-full">
                <livewire:admin::livewire.navbar.sidebar-manager/>
            </div>
        </div>

        <livewire:admin::livewire.tab-manager.tab-manager/>

    </div>

@endsection
