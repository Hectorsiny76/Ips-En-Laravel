@extends('admin_layout.master')

@section('title', 'Actualizar servicio '.$servicio->nombre)

@section('page-title', 'Actualizar servicio '.$servicio->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar Servicio {{$servicio->nombre}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.servicios.update', $servicio->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Soportar TIDEL"
                    value="{{old('nombre', $servicio->nombre)}}"
                    id="nombre"
                    required/>

            </div>
            <x-form-update-buttons href="{{ route('admin.servicios.index') }}"/>
        </form>
    </div>

@endsection
