@extends('admin_layout.master')

@section('title', 'Actualizar Despliegue '.$despliegue->titulo)

@section('page-title', 'Actualizar Despliegue '.$despliegue->titulo)

@section('content')

    <x-div-edit-create-title>Actualizar Despliegue {{$despliegue->titulo}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.despliegues.update', $despliegue->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="titulo">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="titulo"
                    placeholder="Sevenly v4.0 Remix"
                    value="{{old('titulo', $despliegue->titulo)}}"
                    id="titulo"
                    required></x-input-form>

                <x-input-form-label for="descripcion">Descripcion</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion"
                    placeholder="Se actualiza el servicio para que llegen correctamente los mensajes a los clientes nuevos"
                    value="{{old('descripcion', $despliegue->descripcion)}}"
                    id="descripcion"
                    required></x-input-form>

            </div>
            <x-form-update-buttons href="{{ route('admin.establecimientotipo.index') }}"/>
        </form>
    </div>

@endsection
