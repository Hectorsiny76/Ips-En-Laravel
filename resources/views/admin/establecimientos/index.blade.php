@extends('admin_layout.master')

@section('title', 'Establecimientos del Campo '.$campogerente->campo->numero)

@section('page-title', 'Establecimientos del Campo '.$campogerente->campo->numero)

@section('content')

    <x-nav-ol-first href="{{route('admin.estados.index')}}" nombre="Estados">

        <x-nav-ol-li-component
            href="{{ route('admin.estados.gerentes-mercado.index', $campogerente->campo->mercado->mercadogerente->estado) }}">
            Gerentes de mercado de {{ $campogerente->campo->mercado->mercadogerente->estado->nombre }}
        </x-nav-ol-li-component>

        <x-nav-ol-li-component
            href="{{ route('admin.gerentes-mercado.mercados.index', $campogerente->campo->mercado->mercadogerente->id) }}">
            Mercado {{ $campogerente->campo->mercado->numero }} ({{$campogerente->campo->mercado->establecimientotipo->nombre}})
        </x-nav-ol-li-component>

        <x-nav-ol-li-component
            href="{{ route('admin.mercados.campos.index', $campogerente->campo->mercado->id) }}">
            Campos del mercado {{ $campogerente->campo->mercado->numero }}
        </x-nav-ol-li-component>

        <x-nav-ol-li-component
            href="{{route('admin.campo.campo-gerente.index', $campogerente->campo->id)}}">
            Gerente de Campo {{$campogerente->nombre}}
        </x-nav-ol-li-component>

    </x-nav-ol-first>
    <x-div-index-title-create-button
        title="Estos son los establecimientos de {{$campogerente->nombre}}"
        url="{{route('admin.campo-gerente.establecimientos.create', $campogerente->id)}}"
        button="Agregar un nuevo establecimiento"
    />

    <livewire:admin::livewire.establecimientos.index-table :campogerente="$campogerente"/>

@endsection
