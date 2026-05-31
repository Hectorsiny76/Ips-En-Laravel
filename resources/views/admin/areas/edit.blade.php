@extends('admin_layout.master')

@section('title', 'Actualizar Área')

@section('page-title', 'Actualizar Área')

@section('content')

    <x-div-edit-create-title>Actualizar Área</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.areas.update', $area->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="7ly"
                    value="{{old('nombre', $area->nombre)}}"
                    id="nombre"
                    required></x-input-form>

                <x-input-form-label for="nombre">Descripcion</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion"
                    placeholder="Sevenly"
                    value="{{old('descripcion', $area->descripcion)}}"
                    id="descripcion"
                    required></x-input-form>
            </div>
            <x-form-update-buttons href="{{ route('admin.areas.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
