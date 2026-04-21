@extends('admin_layout.master')

@section('title', 'Editar el formato de tienda'.$tiendaformato->nombre)

@section('page-title', 'Editar el formato de tienda'.$tiendaformato->nombre)

@section('content')

    <x-div-edit-create-title>Editar el formato de tienda {{$tiendaformato->nombre}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.tienda-formatos.update', $tiendaformato->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Espacial"
                    value="{{old('nombre', $tiendaformato->nombre)}}"
                    required></x-input-form>
            </div>
            <x-form-update-buttons href="{{route('admin.tienda-formatos.index')}}"/>
        </form>
    </div>

@endsection
