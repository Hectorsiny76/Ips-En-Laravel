
@extends('admin_layout.master')

@section('title', 'Lista de Establecimientos Binomio')

@section('page-title', 'Lista de Establecimientos Binomio')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los establecimientos binomio actuales"
        url="{{route('admin.binomioestablecimientos.create')}}"
        button="Agregar un nuevo duo de establecimientos"
    />

    <livewire:admin::livewire.binomioestablecimientos.index-table/>

@endsection

