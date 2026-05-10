@extends('admin_layout.master')

@section('title', 'Actualizar el tipo de archivo '.$archivoTipo->nombre)

@section('page-title', 'Actualizar el tipo de archivo '.$archivoTipo->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar el Tipo de Archivo {{$archivoTipo->nombre}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.archivo-tipo.update', $archivoTipo->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="PDF"
                    value="{{old('nombre', $archivoTipo->nombre)}}"
                    id="nombre"
                    required/>

                <x-input-form-label for="es_link">¿Es un link?</x-input-form-label>

                <x-input-form-select name="es_link" id="es_link" initialvalue="-- ¿Es link? --">
                    <option value="1" @selected(old('es_link', $archivoTipo->es_link ?? '') == true)>Sí</option>
                    <option value="0" @selected(old('es_link', $archivoTipo->es_link ?? '') == false)>No</option>
                </x-input-form-select>

                <x-input-form-label for="mimes_permitidos">Extensiones Permitidas</x-input-form-label>

                <x-input-form
                    type="text"
                    name="mimes_permitidos"
                    placeholder="pdf"
                    value="{{old('mimes_permitidos', $archivoTipo->mimes_permitidos)}}"
                    id="mimes_permitidos"
                    />

                <x-input-form-label for="tam_max_kb">Tamaño máximo de KB</x-input-form-label>

                <x-input-form
                    type="number"
                    name="tam_max_kb"
                    placeholder="2000"
                    value="{{old('tam_max_kb', $archivoTipo->tam_max_kb)}}"
                    id="tam_max_kb"
                    min="1"
                    />

            </div>
            <x-form-update-buttons href="{{ route('admin.archivo-tipo.index') }}"/>
        </form>
    </div>

@endsection
