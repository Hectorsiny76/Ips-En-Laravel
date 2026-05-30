@extends('admin_layout.master')

@section('title', 'Actualizar Tipo de Caja '.$cajatipo->nombre)

@section('page-title', 'Actualizar Tipo de Caja '.$cajatipo->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar Tipo de Caja {{$cajatipo->nombre}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.caja-tipos.update', $cajatipo->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Tipo</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Caja IA"
                    value="{{old('nombre', $cajatipo->nombre)}}"
                    required></x-input-form>
            </div>
            <x-form-update-buttons href="{{ route('admin.caja-tipos.index') }}"/>
        </form>
    </div>

@endsection
