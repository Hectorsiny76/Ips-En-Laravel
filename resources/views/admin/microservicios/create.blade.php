@extends('admin_layout.master')

@section('title', 'Crear un nuevo Microservicio')

@section('page-title', 'Crear un nuevo Microservicio')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Microservicio</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.microservicios.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Reparar DB..."
                    value="{{old('nombre')}}"
                    id="nombre"
                    required/>

            </div>
            <x-form-create-buttons href="{{ route('admin.microservicios.index') }}"/>
        </form>
    </div>

@endsection
