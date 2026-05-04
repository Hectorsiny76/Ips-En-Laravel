@extends('admin_layout.master')

@section('title', 'Actualizar Programa Piloto '.$pilotoPrograma->titulo)

@section('page-title', 'Actualizar Programa Piloto '.$pilotoPrograma->titulo)

@section('content')

    <x-div-edit-create-title>Actualizar Programa Piloto {{$pilotoPrograma->titulo}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.programas-piloto.update', $pilotoPrograma->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="tienda">Titulo</x-input-form-label>

                <x-input-form
                    type="text"
                    name="titulo"
                    placeholder="ADV v0.2 Pre-Alpha"
                    value="{{old('titulo', $pilotoPrograma->titulo)}}"
                    id="titulo"/>

                <x-input-form-label for="descripcion_corta">Descripción corta</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion_corta"
                    placeholder="Version Preeliminar de ADV enfocada en el Cierre de Dfa"
                    value="{{old('descripcion_corta', $pilotoPrograma->descripcion_corta)}}"
                    id="descripcion_corta"/>

                <x-input-form-label for="descripcion_larga">Descripción larga</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion_larga"
                    placeholder="Version enfocada principalmente en el cierre de dfa, mantenimiento a empleados, sevenly y generación de reportes de mercancía."
                    value="{{old('descripcion_larga', $pilotoPrograma->descripcion_larga)}}"
                    id="descripcion_corta"/>

            </div>
            <x-form-update-buttons href="{{ route('admin.programas-piloto.index') }}"/>
        </form>
    </div>

@endsection
