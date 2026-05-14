@extends('admin_layout.master')

@section('title', 'Microservicios')

@section('page-title', 'Microservicios')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Microservicios actuales"
        url="{{route('admin.microservicios.create')}}"
        button="Agregar un nuevo Microservicio"
    />

    <livewire:admin::livewire.microservicios.index-table/>

@endsection

