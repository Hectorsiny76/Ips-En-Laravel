@extends('admin_layout.master')

@section('title', 'Actualizar el Folio '.$folio->titulo)

@section('page-title', 'Actualizar el Folio '.$folio->titulo)

@section('content')

    <x-div-edit-create-title>Actualizar el Folio {{$folio->titulo}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.folios.update', $folio->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="numero">Numero</x-input-form-label>

                <x-input-form
                    type="text"
                    name="numero"
                    placeholder="INC2010213"
                    value="{{old('numero', $folio->numero)}}"
                    id="numero"
                />

                <x-input-form-label for="titulo">Titulo</x-input-form-label>

                <x-input-form
                    type="text"
                    name="titulo"
                    placeholder="Falla con Sevenly No.2012"
                    value="{{old('titulo', $folio->titulo)}}"
                    id="titulo"
                    required/>

                <x-input-form-label for="descripcion">Descripcion</x-input-form-label>

                <x-input-form
                    type="text"
                    name="descripcion"
                    placeholder="Código de Error '05 No hay mensaje de error definido para este error. Llame al CAS'"
                    value="{{old('descripcion', $folio->descripcion)}}"
                    id="descripcion"/>
            </div>
            <x-form-update-buttons href="{{ route('admin.foliotipos.folios.index', $folio->foliotipo->id) }}"/>
        </form>
    </div>

@endsection
