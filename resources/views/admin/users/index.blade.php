
@extends('admin_layout.master')

@section('title', 'Admins')

@section('page-title', 'Admins')

@section('content')

    <x-div-index-title-create-button title="Estos son los admins actuales" :create="false"/>

    <livewire:admin::livewire.users.index-table/>

@endsection
