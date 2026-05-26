@extends('admin_layout.master')

@section('title', $estTipo->nombre)

@section('page-title', $estTipo->nombre)

@section('content')

    <x-div-index-title-create-button
        title="Tipo de establecimiento: {{$estTipo->nombre}}"
        url="{{ route('admin.estados.index') }}" {{-- TODO AGREGAR UNA RUTA DE CREACION DINÁMICA --}}
        button="Agregar {{$estTipo->nombre}}"
    />

   <livewire:admin::livewire.establecimientotipo.index-table :estTipo="$estTipo"/>

@endsection
