@extends('admin_layout.master')

@section('title', 'Categorías')

@section('page-title', 'Categorías')

@section('content')

    <x-div-index-title-create-button
        title="Estos son las Categorías actuales"
        url="{{route('admin.categorias.create')}}"
        button="Agregar una nueva Categoría"
    />

    <livewire:admin::livewire.categorias.index-table/>

@endsection

