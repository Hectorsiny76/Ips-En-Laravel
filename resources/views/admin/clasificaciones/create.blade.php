@extends('admin_layout.master')

@section('title', 'Crear una nueva clasificación')

@section('page-title', 'Crear una nueva clasificación')

@section('content')

    <x-div-edit-create-title>Crear una nueva Clasificación</x-div-edit-create-title>

    <livewire:admin::livewire.clasificaciones.create-form/>

@endsection
