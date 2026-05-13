@extends('admin_layout.master')

@section('title', 'Actualizar Categoría '. $categoria->nombre)

@section('page-title', 'Actualizar Categoría '. $categoria->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar categoría {{$categoria->nombre}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.categorias.store')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Gestion de Base De Datos"
                    value="{{old('nombre', $categoria->nombre)}}"
                    id="nombre"
                    required/>

            </div>
            <x-form-update-buttons href="{{ route('admin.categorias.index') }}"/>
        </form>
    </div>

@endsection
