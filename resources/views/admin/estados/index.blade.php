@extends('admin_layout.master')

@section('title', 'Estados')

@section('page-title', 'Estados')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los estados actuales"
        url="{{ route('admin.estados.create') }}"
        button="Agregar Estado"
        />

    <livewire:admin::livewire.estados.index-table/>

@endsection
