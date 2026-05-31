@extends('admin_layout.master')

@section('title', 'Crear un nuevo Servicio')

@section('page-title', 'Crear un nuevo Servicio')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Servicio</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.servicios.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Soportar Hand Held"
                    value="{{old('nombre')}}"
                    id="nombre"
                    required/>

            </div>
            <x-form-create-buttons href="{{ route('admin.servicios.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
