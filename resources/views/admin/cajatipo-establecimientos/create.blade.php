@extends('admin_layout.master')

@section('title', 'Crear un nueva relación Establecimiento - Tipo de Caja')

@section('page-title', 'Crear un nueva relación Establecimiento - Tipo de Caja')

@section('content')

    <x-div-edit-create-title>Crear un nueva relación Establecimiento - Tipo de Cajaa</x-div-edit-create-title>

    <livewire:admin::livewire.cajatipo-establecimiento.create-form/>

@endsection
