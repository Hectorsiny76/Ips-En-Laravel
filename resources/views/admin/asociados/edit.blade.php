@extends('admin_layout.master')

@section('title', 'Actualizar al Asociado '.$asociado->nombre)

@section('page-title', 'Actualizar al Asociado '.$asociado->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar al Asociado {{$asociado->nombre}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.asociados.update', $asociado->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Pedro Fernandez"
                    value="{{old('nombre', $asociado->nombre)}}"
                    id="nombre"
                    required></x-input-form>

                <x-input-form-label for="tel">Teléfono</x-input-form-label>

                <x-input-form
                    type="tel"
                    name="tel"
                    placeholder="8182324124"
                    value="{{old('tel', $asociado->tel)}}"
                    id="tel"
                />

                <x-input-form-label for="email">Correo</x-input-form-label>

                <x-input-form
                    type="email"
                    name="email"
                    placeholder="example@example.com"
                    value="{{old('email', $asociado->email)}}"
                    id="email"
                />

            </div>
            <x-form-update-buttons href="{{ route('admin.areas.asociados.index', $asociado->area->id) }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
