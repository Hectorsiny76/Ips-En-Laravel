@extends('admin_layout.master')

@section('title', 'Lista de Contratos Ávalon')

@section('page-title', 'Lista de Contratos Ávalon')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Contratos Ávalon existentes"
        url="{{route('admin.avalon-contratos.create')}}"
        button="Agregar un nuevo Contrato Ávalon"
    />

    <livewire:admin::livewire.avalon-contratos.index-table/>

@endsection

