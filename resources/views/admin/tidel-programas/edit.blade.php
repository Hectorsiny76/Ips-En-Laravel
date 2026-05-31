@extends('admin_layout.master')

@section('title', 'Editar la migración tidel '.$tidelprograma->id)

@section('page-title', 'Editar la migración tidel '.$tidelprograma->id)

@section('content')

    <x-div-edit-create-title>Crear una nueva migración a TIDEL</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.tidel-programas.update', $tidelprograma->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="ip">IP TIDEL</x-input-form-label>

                <x-input-form
                    type="text"
                    name="ip"
                    placeholder="8.8.8.8"
                    value="{{old('ip', $tidelprograma->ip)}}"
                    required></x-input-form>

                <x-input-form-label for="fechamigracion">Fecha Migracion</x-input-form-label>

                <x-input-form
                    type="date"
                    name="fechamigracion"
                    placeholder=""
                    value="{{old('fecha', $tidelprograma->fechamigracion)}}"
                ></x-input-form>
            </div>

            <x-form-update-buttons href="{{route('admin.tidel-programas.index')}}"/>

        </form>
    </x-div-form-create-edit>

@endsection
