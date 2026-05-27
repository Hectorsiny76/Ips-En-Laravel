@extends('admin_layout.master')

@section('title', 'Editar los archivos del establecimiento '.$estTipo->nombre)

@section('page-title', 'Editar los archivos del establecimiento '.$estTipo->nombre)

@section('content')

    @livewire('admin::livewire.establecimientotipo.est-type-edit-with-file-add', ['estTipo' => $estTipo])

@endsection
