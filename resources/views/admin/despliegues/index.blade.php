
@extends('admin_layout.master')

@section('title', 'Áreas')

@section('page-title', 'Áreas')

@section('content')

    <x-div-index-title-create-button
        title="Estos son despliegues actuales"
        url="{{route('admin.despliegues.create')}}"
        button="Agregar un nuevo Despliegue"
    />

    <livewire:admin::livewire.despliegues.index-table/>

@endsection

