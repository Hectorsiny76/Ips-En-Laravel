@extends('admin_layout.master')

@section('title', 'Crear un campo del Mercado '.$mercado->numero)

@section('page-title', 'Crear un campo del Mercado '.$mercado->numero)

@section('content')

    <x-div-edit-create-title>Crear campo del Mercado {{$mercado->numero}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.mercados.campos.store', $mercado->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="numero">Número</x-input-form-label>

                <x-input-form
                    type="number"
                    name="numero"
                    placeholder="2"
                    value="{{old('numero')}}"
                    min="1"
                    step="1"
                    required
                />

                <x-input-form-label for="Mercado">Mercado</x-input-form-label>

                <x-input-form
                    type="number"
                    name="Mercado"
                    value="{{$mercado->numero}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    readonly
                />
            </div>
            <x-form-create-buttons href="{{route('admin.mercados.campos.index', $mercado->id)}}"/>
        </form>
    </x-div-form-create-edit>

@endsection
