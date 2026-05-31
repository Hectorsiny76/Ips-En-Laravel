@extends('admin_layout.master')

@section('title', 'Editar campo '.$campo->numero)

@section('page-title', 'Editar campo '.$campo->numero)

@section('content')

    <x-div-edit-create-title>Editar campo {{$campo->numero}}</x-div-edit-create-title>

    <x-div-form-create-edit>

        <x-form-errors/>

        <form action="{{route('admin.campos.update', $campo->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Número</x-input-form-label>

                <x-input-form
                    type="number"
                    name="numero"
                    placeholder="2"
                    value="{{old('numero', $campo->numero)}}"
                    min="1"
                    step="1"
                    required
                />

                <x-input-form-label for="Mercado">Mercado</x-input-form-label>

                <x-input-form
                    type="text"
                    name="Mercado"
                    value="{{$campo->mercado->numero}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    readonly
                />

            </div>

            <x-form-update-buttons href="{{route('admin.mercados.campos.index', $campo->mercado->id)}}"/>

        </form>
    </x-div-form-create-edit>

@endsection
