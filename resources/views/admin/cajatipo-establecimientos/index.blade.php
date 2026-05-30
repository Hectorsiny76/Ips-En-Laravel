@extends('admin_layout.master')

@section('title', 'Tipos de POS')

@section('page-title', 'Tipos de POS')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Establecimientos y sus Tipos de Caja Actuales"
        url="{{route('admin.cajatipo-establecimiento.create')}}"
        button="Agregar una nueva relación"
    />

    <livewire:admin::livewire.cajatipo-establecimiento.index-table/>

@endsection
