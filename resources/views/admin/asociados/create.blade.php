@extends('admin_layout.master')

@section('title', 'Crear un nuevo Asociado')

@section('page-title', 'Crear un nuevo Asociado')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Asociado</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.areas.asociados.store', $area->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Pedro Fernandez"
                    value="{{old('nombre')}}"
                    id="nombre"
                    required></x-input-form>

                <x-input-form-label for="tel">Teléfono</x-input-form-label>

                <x-input-form
                    type="tel"
                    name="tel"
                    placeholder="8182324124"
                    value="{{old('tel')}}"
                    id="tel"
                    />

                <x-input-form-label for="email">Correo</x-input-form-label>

                <x-input-form
                    type="email"
                    name="email"
                    placeholder="example@example.com"
                    value="{{old('email')}}"
                    id="email"
                    />

            </div>
            <x-form-create-buttons href="{{ route('admin.areas.asociados.index', $area->id) }}"/>
        </form>
    </div>

@endsection
