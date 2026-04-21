@extends('admin_layout.master')

@section('title', 'Editar el Contrato Ávalon '.$avaloncontrato->id)

@section('page-title', 'Editar el Contrato Ávalon '.$avaloncontrato->id)

@section('content')

    <x-div-edit-create-title>Editar el Contrato Ávalon {{$avaloncontrato->id}}</x-div-edit-create-title>

    <div class="flex-1 overflow-auto bg-white shadow rounded-lg p-3">
        <x-form-errors/>
        <form action="{{route('admin.avalon-contratos.update', $avaloncontrato->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="numero">Numero</x-input-form-label>

                <x-input-form
                    type="number"
                    name="numero"
                    placeholder="78787847"
                    value="{{old('numero', $avaloncontrato->numero)}}"
                    required
                    id="numero"/>

                <x-input-form-label for="estatus">Estatus</x-input-form-label>

                <x-input-form-select name="estatus_id" id="estatus" initialvalue="-- Estatus --">
                    @foreach($estatuses as $estatus)
                        <option value="{{$estatus->id}}" @selected(old('estatus_id', $avaloncontrato->estatus_id ?? "") == $estatus->id)>{{$estatus->nombre}}</option>
                    @endforeach
                </x-input-form-select>

                <x-input-form-label for="estacion">Estaciones sin contrato</x-input-form-label>
                <x-input-form-select name="establecimiento_id" id="estacion" initialvalue="-- Estaciones sin contrato asignado --">
                    @foreach($estacionesSinContrato as $id => $nombre)
                        <option value="{{$id}}" @selected(old('establecimiento_id', $avaloncontrato->establecimiento->id ?? "") == $id)>{{$nombre}}</option>
                    @endforeach
                </x-input-form-select>

            </div>
            <x-form-update-buttons href="{{ route('admin.avalon-contratos.index') }}"/>
        </form>
    </div>

@endsection
