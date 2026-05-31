@extends('admin_layout.master')

@section('title', 'Crear un nuevo Programa Piloto')

@section('page-title', 'Crear un nuevo Programa Piloto')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Programa Piloto</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.programas-piloto.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="tienda">Titulo</x-input-form-label>

                <x-input-form
                    type="text"
                    name="titulo"
                    placeholder="ADV v0.2 Pre-Alpha"
                    value="{{old('titulo')}}"
                    id="titulo"
                    required
                />

                <x-input-form-label for="descripcion_corta">Descripción corta</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion_corta"
                    placeholder="Version Preeliminar de ADV enfocada en el Cierre de Dfa"
                    value="{{old('descripcion_corta')}}"
                    id="descripcion_corta"
                    required
                />

                <x-input-form-label for="descripcion_larga">Descripción larga</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion_larga"
                    placeholder="Version enfocada principalmente en el cierre de dfa, mantenimiento a empleados, sevenly y generación de reportes de mercancía."
                    value="{{old('descripcion_larga')}}"
                    id="descripcion_corta"
                    required
                />

                <livewire:admin::livewire.programas-piloto.search-est/>
            </div>
            <x-form-create-buttons href="{{ route('admin.programas-piloto.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
