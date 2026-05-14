@extends('admin_layout.master')

@section('title', 'Actualizar Clasificación')

@section('page-title', 'Actualizar Clasificación')

@section('content')

    <x-div-edit-create-title>Actualizar Clasificación</x-div-edit-create-title>

    <livewire:admin::livewire.clasificaciones.edit-form :clasificacion="$clasificacion"/>

@endsection
