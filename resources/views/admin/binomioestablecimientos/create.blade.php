@extends('admin_layout.master')

@section('title', 'Crear un nuevo DUO de establecimientos binomio')

@section('page-title', 'Crear un nuevo DUO de establecimientos binomio')

@section('content')

    <x-div-edit-create-title>Crear un nuevo DUO de establecimientos binomio</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.binomioestablecimientos.store')}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="tienda">Tiendas sin estación</x-input-form-label>

                <x-input-form-select name="tienda_id" id="tiendas" initialvalue="--> Tiendas No Binomio <--">
                    @foreach($tiendas as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                </x-input-form-select>

                <x-input-form-label for="estacion">Estaciones sin tienda</x-input-form-label>

                <x-input-form-select name="estacion_id" id="estacion" initialvalue="--> Estaciones No Binomio <--">
                    @foreach($estaciones as $id => $name)
                        <option value="{{$id}}">{{$name}}</option>
                    @endforeach
                </x-input-form-select>
            </div>
            <x-form-create-buttons href="{{ route('admin.binomioestablecimientos.index') }}"/>
        </form>
    </x-div-form-create-edit>

@endsection
