@extends('admin_layout.master')

@section('title', 'Crear una nueva categoría')

@section('page-title', 'Crear una nueva categoría')

@section('content')

    <x-div-edit-create-title>Crear una nueva categoría</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.categorias.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Gestion de Base De Datos"
                    value="{{old('nombre')}}"
                    id="nombre"
                    required/>

            </div>
            <x-form-create-buttons href="{{ route('admin.categorias.index') }}"/>
        </form>
    </div>

@endsection
