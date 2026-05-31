@extends('admin_layout.master')

@section('title', 'Crear un gerente para el Campo '.$campo->numero)

@section('page-title', 'Crear un gerente para el Campo '.$campo->numero)

@section('content')

    <x-div-edit-create-title>Crear gerente para el Campo {{$campo->numero}}</x-div-edit-create-title>

    <x-div-form-create-edit>

        <x-form-errors/>

        <form action="{{route('admin.campo.campo-gerente.store', $campo->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Elmer Homero"
                    value="{{old('nombre')}}"
                    required
                />

                <x-input-form-label for="tel">Teléfono</x-input-form-label>

                <x-input-form
                    type="tel"
                    name="tel"
                    placeholder="8181818181"
                    value="{{old('tel')}}"
                    required
                />

                <x-input-form-label for="correo" >Correo</x-input-form-label>

                <x-input-form
                    type="email"
                    name="correo"
                    placeholder="example@example.com"
                    value="{{old('correo')}}"
                    required
                />

                <x-input-form-label for="campo">Campo</x-input-form-label>

                <x-input-form
                    name="campo"
                    type="number"
                    value="{{$campo->numero}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    readonly
                />

            </div>

            <x-form-create-buttons href="{{route('admin.mercados.campos.index', $campo->id)}}"/>

        </form>
    </x-div-form-create-edit>

@endsection

