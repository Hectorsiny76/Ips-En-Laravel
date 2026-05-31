@extends('admin_layout.master')

@section('title', 'Crear un nuevo Tipo de Folio')

@section('page-title', 'Crear un nuevo Tipo de Folio')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Tipo de Folio</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.foliotipos.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Tipo</x-input-form-label>

                <x-input-form
                    type="text"
                    name="tipo"
                    placeholder="Incidente"
                    value="{{old('tipo')}}"
                    required></x-input-form>
            </div>
            <x-form-create-buttons href="{{ route('admin.foliotipos.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
