@extends('admin_layout.master')

@section('title', 'Lista de migraciones tidel')

@section('page-title', 'Lista de migraciones tidel')

@section('content')

    <x-div-index-title-create-button
        title="Estas son las migraciones hechas a Tidel"
        url="{{ route('admin.tidel-programas.create')}}"
        button="Agregar Migración a Tidel"
        />

    <livewire:admin::livewire.tidel-programas.index-table/>

@endsection
