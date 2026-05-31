@extends('admin_layout.master')

@section('title', 'Crear una nueva subcategoría')

@section('page-title', 'Crear una nueva subcategoría')

@section('content')

    <x-div-edit-create-title>Crear una nueva Subcategoría</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.subcategorias.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Manejo de Base De Datos"
                    value="{{old('nombre')}}"
                    id="nombre"
                    required/>

            </div>
            <x-form-create-buttons href="{{ route('admin.subcategorias.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
