@extends('admin_layout.master')

@section('title', 'Actualizar subcategoría '.$subcategoria->nombre)

@section('page-title', 'Actualizar subcategoría '.$subcategoria->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar Subcategoría {{$subcategoria->nombre}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.subcategorias.update', $subcategoria->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Manejo de Base De Datos"
                    value="{{old('nombre', $subcategoria->nombre)}}"
                    id="nombre"
                    required/>

            </div>
            <x-form-update-buttons href="{{ route('admin.subcategorias.index') }}"/>
        </form>
    </div>

@endsection
