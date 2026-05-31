@extends('admin_layout.master')

@section('title', 'Crear un nuevo Despliegue')

@section('page-title', 'Crear un nuevo Despliegue')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Despliegue</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.despliegues.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="titulo">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="titulo"
                    placeholder="Sevenly v4.0 Remix"
                    value="{{old('titulo')}}"
                    id="titulo"
                    required></x-input-form>

                <x-input-form-label for="descripcion">Descripcion</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion"
                    placeholder="Se actualiza el servicio para que llegen correctamente los mensajes a los clientes nuevos"
                    value="{{old('descripcion')}}"
                    id="descripcion"
                    required></x-input-form>

                <x-input-form-label for="area_id">Area</x-input-form-label>
                <x-input-form-select name="area_id" id="area_id" initialvalue=" -- Escoge una area -- ">
                    @foreach($areas as $area)
                        <option value="{{$area->id}}" @selected(old('area_id'))>{{$area->nombre}} - {{$area->descripcion}}</option>
                    @endforeach
                </x-input-form-select>

                <x-input-form-label for="inicio">Fecha Inicio</x-input-form-label>

                <x-input-form
                    type="date"
                    name="inicio"
                    placeholder=""
                    value="{{old('inicio')}}"
                    id="inicio"
                    required></x-input-form>

                <x-input-form-label for="fin">Fecha Fin</x-input-form-label>

                <x-input-form
                    type="date"
                    name="fin"
                    placeholder=""
                    value="{{old('fin')}}"
                    id="fin"
                    required></x-input-form>

            </div>
            <x-form-create-buttons href="{{ route('admin.despliegues.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
