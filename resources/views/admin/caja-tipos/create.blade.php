@extends('admin_layout.master')

@section('title', 'Crear un nuevo Tipo de Caja')

@section('page-title', 'Crear un nuevo Tipo de Caja')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Tipo de Caja</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.caja-tipos.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Tipo</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Caja IA"
                    value="{{old('nombre')}}"
                    required></x-input-form>
            </div>
            <x-form-create-buttons href="{{ route('admin.caja-tipos.index') }}"/>
        </form>
    </div>

@endsection
