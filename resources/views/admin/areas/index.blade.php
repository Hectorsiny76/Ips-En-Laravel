
@extends('admin_layout.master')

@section('title', 'Áreas')

@section('page-title', 'Áreas')

@section('content')

    <x-div-index-title-create-button
        title="Estos son las Áreas actuales"
        url="{{route('admin.areas.create')}}"
        button="Agregar una nueva Área"
    />

    <livewire:admin::livewire.areas.index-table/>

@endsection

