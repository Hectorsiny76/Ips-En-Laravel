@extends('admin_layout.master')

@section('title', 'Gerentes de mercado de '.$estado->nombre)

@section('page-title', 'Gerentes de mercado de '.$estado->nombre)

@section('content')
    <x-nav-ol-first href="{{route('admin.estados.index')}}" nombre="Estados"/>

    <x-div-index-title-create-button
        title="Estos son los gerentes de mercado de {{$estado->nombre}}"
        url="{{ route('admin.estados.gerentes-mercado.create', $estado->id)}}"
        button="Agregar Gerente de Mercado"
        />

    <livewire:admin::livewire.gerentes-mercado.index-table :estado="$estado"/>

@endsection
