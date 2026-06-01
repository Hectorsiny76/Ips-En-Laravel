@extends('admin_layout.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')
    <div  class="w-full flex flex-col min-h-0 flex-1">

        <x-div-index-title-create-button title="Bienvenido, estos son los datos actuales" url="/" button="Página Principal"/>

        <div class="flex flex-1 min-h-0 flex-col overflow-y-auto">
            <ul class="space-y-4 mb-4 pr-2">
                <li class="p-4 dark:bg-gray-800 dark:text-gray-300 bg-white shadow rounded-lg">
                    <strong>Establecimientos totales</strong>
                    <span>
                    ({{$establecimientos}})
                    </span>
                </li>

                @forelse($establecimientoTipos as $establecimientoTipo)
                    <li class="p-4 dark:bg-gray-800 dark:text-gray-300  bg-white shadow rounded-lg">
                        <a href="{{route('admin.establecimientotipo.show', $establecimientoTipo->id)}}"
                           class="dark:hover:text-blue-400/50 hover:text-blue-900">
                            <strong>{{$establecimientoTipo->nombre}}</strong>
                            <span>
                    ({{$establecimientoTipo->establecimientos_count}})
                </span>
                        </a>
                    </li>

                @empty

                    <div
                        class="p-6 dark:bg-gray-800 dark:text-gray-300  bg-yellow-50 text-shadow-yellow-700 border border-b-yellow-200 rounded-lg text-center">
                        <a href="{{route('admin.establecimientotipo.create')}}" class="dark:hover:text-blue-400/50 hover:text-blue-900">
                            <p>No hay establecimientos aún. Agrega uno</p>
                        </a>
                    </div>

                @endforelse

                <li class="p-4 dark:bg-gray-800 dark:text-gray-300  bg-white shadow rounded-lg">
                    <a href="{{route('admin.programas-piloto.index')}}" class=" dark:hover:text-blue-400/50 hover:text-blue-900">
                        <strong>Programas piloto</strong>

                        <span>
                    ({{$programasPiloto}})
                </span>
                    </a>
                </li>
            </ul>

            <div class="w-full flex-1 pr-2">
                <div class="w-full dark:bg-gray-800 p-4 mb-2 border-2 rounded-md border-double">

                    <livewire:admin::livewire.navbar.navbar-manager/>

                </div>

                <div class="w-full dark:bg-gray-800 border-2 rounded-md border-double">

                    <livewire:admin::livewire.navbar.sidebar-manager/>

                </div>
            </div>

            <div class="flex-1">
                <livewire:admin::livewire.tab-manager.tab-manager/>
            </div>

        </div>

    </div>

@endsection
