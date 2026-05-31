@extends('admin_layout.master')

@section('title', 'Agregar estado')

@section('page-title', 'Agregar estado')

@section('content')

    <x-div-edit-create-title>Agrega un estado nuevo</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.estados.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Oaxaca"
                    value="{{old('nombre')}}"
                    required
                />
            </div>

            <x-form-create-buttons href="{{route('admin.estados.index')}}"/>
        </form>
    </x-div-form-create-edit>

@endsection
