@extends('admin_layout.master')

@section('title', 'Crear un nuevo tipo de archivo')

@section('page-title', 'Crear un nuevo tipo de archivo')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Tipo de Archivo</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.archivo-tipo.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="PDF"
                    value="{{old('nombre')}}"
                    id="nombre"
                    required/>

                <x-input-form-label for="es_link">¿Es un link?</x-input-form-label>

                <x-input-form-select name="es_link" id="es_link" initialvalue="-- ¿Es link? --">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </x-input-form-select>

                <x-input-form-label for="mimes_permitidos">Extensiones Permitidas</x-input-form-label>

                <x-input-form
                    type="text"
                    name="mimes_permitidos"
                    placeholder="pdf"
                    value="{{old('mimes_permitidos')}}"
                    id="mimes_permitidos"
                    />

                <x-input-form-label for="tam_max_kb">Tamaño máximo de KB</x-input-form-label>

                <x-input-form
                    type="number"
                    name="tam_max_kb"
                    placeholder="2000"
                    value="{{old('tam_max_kb')}}"
                    id="tam_max_kb"
                    min="1"
                    />

            </div>
            <x-form-create-buttons href="{{ route('admin.archivo-tipo.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
