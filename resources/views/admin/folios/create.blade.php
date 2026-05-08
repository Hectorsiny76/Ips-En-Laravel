@extends('admin_layout.master')

@section('title', 'Crear un nuevo Folio '.$folioTipo->tipo)

@section('page-title', 'Crear un nuevo Folio '.$folioTipo->tipo)

@section('content')

    <x-div-edit-create-title>Crear un nuevo Folio {{$folioTipo->tipo}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.foliotipos.folios.store', $folioTipo->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="numero">Numero</x-input-form-label>

                <x-input-form
                    type="text"
                    name="numero"
                    placeholder="INC2010213"
                    value="{{old('numero')}}"
                    id="numero"
                    />

                <x-input-form-label for="titulo">Titulo</x-input-form-label>

                <x-input-form
                    type="text"
                    name="titulo"
                    placeholder="Falla con Sevenly No.2012"
                    value="{{old('titulo')}}"
                    id="titulo"
                    required/>

                <x-input-form-label for="descripcion">Descripcion</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion"
                    placeholder="Código de Error '05 No hay mensaje de error definido para este error. Llame al CAS'"
                    value="{{old('descripcion')}}"
                    id="descripcion"/>
            </div>
            <x-form-create-buttons href="{{ route('admin.foliotipos.folios.index', $folioTipo->id) }}"/>
        </form>
    </div>

@endsection
