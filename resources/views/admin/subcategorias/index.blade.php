@extends('admin_layout.master')

@section('title', 'Subcategorías')

@section('page-title', 'Subcategorías')

@section('content')

    <x-div-index-title-create-button
        title="Estos son las Subategorías actuales"
        url="{{route('admin.subcategorias.create')}}"
        button="Agregar una nueva Subcategoría"
    />

    <livewire:admin::livewire.subcategorias.index-table/>

@endsection

