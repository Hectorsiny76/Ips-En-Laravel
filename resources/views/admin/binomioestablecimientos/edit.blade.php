@extends('admin_layout.master')

@section('title', 'Actualizar el DUO '. $estBinomio->id)

@section('page-title', 'Actualizar el DUO '. $estBinomio->id)

@section('content')

    <x-div-edit-create-title>Actualizar el DUO {{$estBinomio->id}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.binomioestablecimientos.update', $estBinomio->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="tienda">Tiendas sin estación</x-input-form-label>

                <x-input-form-select name="tienda_id" id="tiendas" initialvalue="--> Tiendas No Binomio <--">
                    @foreach($tiendas as $id => $name)
                        <option value="{{$id}}" @selected(old('tienda_id', $estBinomio->tienda_id ?? "") == $id)>{{$name}}</option>
                    @endforeach
                </x-input-form-select>

                <x-input-form-label for="estacion">Estaciones sin tienda</x-input-form-label>

                <x-input-form-select name="estacion_id" id="estacion" initialvalue="--> Estaciones No Binomio <--">
                    @foreach($estaciones as $id => $name)
                        <option value="{{$id}}" @selected(old('estacion_id', $estBinomio->estacion_id ?? "") == $id)>{{$name}}</option>
                    @endforeach
                </x-input-form-select>
            </div>
            <x-form-update-buttons href="{{ route('admin.binomioestablecimientos.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
