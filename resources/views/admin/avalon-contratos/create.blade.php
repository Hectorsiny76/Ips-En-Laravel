@extends('admin_layout.master')

@section('title', 'Crear un nuevo Contrato Ávalon')

@section('page-title', 'Crear un nuevo Contrato Ávalon')

@section('content')

    <x-div-edit-create-title>Crear un nuevo Contrato Ávalon</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.avalon-contratos.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="numero">Numero</x-input-form-label>

                <x-input-form
                    type="number"
                    name="numero"
                    placeholder="78787847"
                    value="{{old('numero')}}"
                    required
                    id="numero"
                    min="1"
                />

                <x-input-form-label for="estatus">Estatus</x-input-form-label>

                <x-input-form-select name="estatus_id" id="estatus" initialvalue="-- Estatus --">
                    @foreach($estatuses as $estatus)
                        <option value="{{$estatus->id}}">{{$estatus->nombre}}</option>
                    @endforeach
                </x-input-form-select>

                <x-input-form-label for="estacion">Estaciones sin contrato</x-input-form-label>
                <x-input-form-select name="establecimiento_id" id="estacion" initialvalue="-- Estaciones sin contrato asignado --">
                    @foreach($estacionesSinContrato as $id => $nombre)
                        <option value="{{$id}}">{{$nombre}}</option>
                    @endforeach
                </x-input-form-select>

            </div>
            <x-form-create-buttons href="{{ route('admin.avalon-contratos.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
