@extends('admin_layout.master')

@section('title', 'Actualizar servicio '.$servicio->nombre)

@section('page-title', 'Actualizar servicio '.$servicio->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar Servicio {{$servicio->nombre}}</x-div-edit-create-title>

    <x-div-form-create-edit>
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
    </x-div-form-create-edit>

@endsection
