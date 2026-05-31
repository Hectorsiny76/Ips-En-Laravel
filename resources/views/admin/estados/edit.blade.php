@extends('admin_layout.master')

@section('title', 'Modificar estado')

@section('page-title', 'Modificar estado')

@section('content')

    <x-div-edit-create-title>Actualizar estado {{$estado->nombre}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.estados.update', $estado->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Oaxaca"
                    value="{{old('nombre', $estado->nombre)}}"
                    required
                />

            </div>
            <x-form-update-buttons href="{{route('admin.estados.index')}}"/>
        </form>
    </x-div-form-create-edit>

@endsection
