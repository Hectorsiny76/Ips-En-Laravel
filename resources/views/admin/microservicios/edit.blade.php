@extends('admin_layout.master')

@section('title', 'Actualizar microservicio '.$microservicio->nombre)

@section('page-title', 'Actualizar microservicio '.$microservicio->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar Microservicio {{$microservicio->nombre}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.microservicios.update', $microservicio->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Reparar DB..."
                    value="{{old('nombre', $microservicio->nombre)}}"
                    id="nombre"
                    required/>

            </div>
            <x-form-update-buttons href="{{ route('admin.microservicios.index') }}"/>
        </form>
    </div>

@endsection
