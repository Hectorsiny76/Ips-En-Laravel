@extends('admin_layout.master')

@section('title', 'Clasificaciones')

@section('page-title', 'Clasificaciones')

@section('content')

    <x-div-index-title-create-button
        title="Estos son las clasificaciones actuales"
        url="{{route('admin.clasificaciones.create')}}"
        button="Agregar una nueva clasificación"
    />

    <livewire:admin::livewire.clasificaciones.index-table/>

@endsection

