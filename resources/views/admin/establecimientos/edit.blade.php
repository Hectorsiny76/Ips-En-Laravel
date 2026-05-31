@extends('admin_layout.master')

@section('title', 'Actualizar '.$estTipo->nombre.' '.$establecimiento->nombre)

@section('page-title', 'Actualizar '.$estTipo->nombre.' '.$establecimiento->nombre)

@section('content')

    <x-div-edit-create-title>Actualizar {{$estTipo->nombre}} {{$establecimiento->nombre}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.establecimientos.update', $establecimiento->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Agua Caliente"
                    value="{{old('nombre', $establecimiento->nombre)}}"
                    required/>

                <x-input-form-label for="numero">Numero</x-input-form-label>

                <x-input-form
                    type="number"
                    name="numero"
                    placeholder="192"
                    value="{{old('numero', $establecimiento->numero)}}"
                    min="1"
                    required/>

                <x-input-form-label for="cajas_tpvs">
                    @if($estTipoNombre == 'tienda')
                        Cajas
                    @elseif($estTipoNombre == 'estacion')
                        TPV's
                    @endif
                </x-input-form-label>

                <x-input-form
                    type="number"
                    name="cajas_tpvs"
                    placeholder="4"
                    value="{{old('cajas_tpvs', $establecimiento->cajas_tpvs)}}"
                    min="1"
                    required/>

                <x-input-form-label for="idred">Id de Red</x-input-form-label>

                <x-input-form
                    type="text"
                    name="idred"
                    placeholder="8.8.8"
                    value="{{old('idred', $establecimiento->idred)}}"
                    required/>

                @includeIf('admin.establecimientos.partials-edit.'.$estTipoNombre)

            </div>
            <x-form-update-buttons href="{{route('admin.campo-gerente.establecimientos.index', $establecimiento->campogerente->id)}}"/>
        </form>
    </x-div-form-create-edit>

@endsection

