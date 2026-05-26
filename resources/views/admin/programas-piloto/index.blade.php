
@extends('admin_layout.master')

@section('title', 'Lista de Programas Piloto')

@section('page-title', 'Lista de Programas Piloto')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Programas Piloto Actuales"
        url="{{route('admin.programas-piloto.create')}}"
        button="Agregar un nuevo programa piloto"
    />

    <livewire:admin::livewire.programas-piloto.index-table/>

@endsection

