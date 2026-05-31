@extends('admin_layout.master')

@section('title', 'Crear una nueva Área')

@section('page-title', 'Crear una nueva Área')

@section('content')

    <x-div-edit-create-title>Crear una nueva Área</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.areas.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="7ly"
                    value="{{old('nombre')}}"
                    id="nombre"
                    required></x-input-form>

                <x-input-form-label for="descripcion">Descripcion</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion"
                    placeholder="Sevenly"
                    value="{{old('descripcion')}}"
                    id="descripcion"
                    required></x-input-form>
            </div>
            <x-form-create-buttons href="{{ route('admin.areas.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
