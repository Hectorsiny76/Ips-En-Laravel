@extends('admin_layout.master')

@section('title', 'Crear un nuevo formato de tienda')

@section('page-title', 'Crear un nuevo formato de tienda')

@section('content')

    <x-div-edit-create-title>Crear un nuevo formato de tienda</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.tienda-formatos.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Espacial"
                    value="{{old('nombre')}}"
                    required></x-input-form>
            </div>
            <x-form-create-buttons href="{{ route('admin.tienda-formatos.index') }}"/>
        </form>
    </div>

@endsection
