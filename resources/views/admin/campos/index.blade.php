@extends('admin_layout.master')

@section('title', 'Campos del mercado '.$mercado->numero)

@section('page-title', 'Campos del mercado '.$mercado->numero)

@section('content')

    <x-nav-ol-first href="{{route('admin.estados.index')}}" nombre="Estados">

        <x-nav-ol-li-component href="{{ route('admin.estados.gerentes-mercado.index', $mercado->mercadogerente->estado) }}">
            Gerentes de Mercado de {{$mercado->mercadogerente->estado->nombre}}
        </x-nav-ol-li-component>

        <x-nav-ol-li-component href="{{ route('admin.gerentes-mercado.mercados.index', $mercado->mercadogerente->id) }}">
            Mercado {{ $mercado->numero }} ({{$mercado->establecimientotipo->nombre}})
        </x-nav-ol-li-component>

    </x-nav-ol-first>

    <x-div-index-title-create-button
        url="{{ route('admin.mercados.campos.create', $mercado)}}"
        title="Estos son los campos del mercado {{$mercado->numero}}"
        button="Agregar Campo"
        />

    <livewire:admin::livewire.campos.index-table :mercado="$mercado"/>

@endsection
