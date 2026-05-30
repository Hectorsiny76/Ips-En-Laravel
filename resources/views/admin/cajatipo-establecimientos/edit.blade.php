@extends('admin_layout.master')

@section('title', 'Actualizar la relación Establecimiento - Tipo de Caja')

@section('page-title', 'Actualizar la relación Establecimiento - Tipo de Caja')

@section('content')

    <x-div-edit-create-title>Actualizar la relación Establecimiento - Tipo de Caja</x-div-edit-create-title>

    <livewire:admin::livewire.cajatipo-establecimiento.edit-form :estCajaTipo="$estCajaTipo"/>

@endsection
