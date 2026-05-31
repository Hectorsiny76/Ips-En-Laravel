@extends('admin_layout.master')

@section('title', 'Actualizar al gerente de campo'.$campo->campogerente->nombre)

@section('page-title', 'Actualizar al gerente de campo'.$campo->campogerente->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar los datos del gerente de campo {{$campo->campogerente->nombre}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.campo-gerente.update', $campo->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">NOmbre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Elmer Homero"
                    value="{{old('nombre', $campo->campogerente->nombre)}}"
                    required
                />

                <x-input-form-label for="tel">Teléfono</x-input-form-label>

                <x-input-form
                    type="tel"
                    name="tel"
                    placeholder="8181818181"
                    value="{{old('tel', $campo->campogerente->tel)}}"
                    required
                />

                <x-input-form-label for="correo">Correo</x-input-form-label>

                <x-input-form
                    type="email"
                    name="correo"
                    placeholder="example@example.com"
                    value="{{old('correo', $campo->campogerente->correo)}}"
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

            <x-form-update-buttons href="{{route('admin.campo.campo-gerente.index', $campo->id)}}"/>
        </form>
    </x-div-form-create-edit>

@endsection

