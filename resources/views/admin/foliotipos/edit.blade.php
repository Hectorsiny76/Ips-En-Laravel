@extends('admin_layout.master')

@section('title', 'Editar el Tipo de Folio: '.$foliotipo->tipo)

@section('page-title', 'Editar el Tipo de Folio: '.$foliotipo->tipo)

@section('content')

    <x-div-edit-create-title>Editar el Tipo de Folio: {{$foliotipo->tipo}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.foliotipos.update', $foliotipo->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Tipo</x-input-form-label>

                <x-input-form
                    type="text"
                    name="tipo"
                    placeholder="Incidente"
                    value="{{old('tipo', $foliotipo->tipo)}}"
                    required></x-input-form>
            </div>
            <x-form-update-buttons href="{{ route('admin.foliotipos.index') }}"/>
        </form>
    </div>

@endsection
