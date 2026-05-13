@extends('admin_layout.master')

@section('title', 'Servicios')

@section('page-title', 'Servicios')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Servicios actuales"
        url="{{route('admin.servicios.create')}}"
        button="Agregar un nuevo Servicio"
    />

    <livewire:admin::livewire.servicios.index-table/>

@endsection

