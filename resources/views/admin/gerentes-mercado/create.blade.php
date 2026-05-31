@extends('admin_layout.master')

@section('title', 'Gerentes de mercado de ' . $estado->nombre)

@section('page-title', 'Gerentes de mercado de ' . $estado->nombre)

@section('content')

    <x-div-edit-create-title>Agregar un gerente de mercado nuevo del estado de {{$estado->nombre}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <form action="{{route('admin.estados.gerentes-mercado.store', $estado->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Mr. Smith"
                    value="{{old('nombre')}}"
                    class="w-full rounded-md shadow-sm focus:ring-sky-700 focus:border-sky-700"
                    required
                />
            </div>

            <x-form-create-buttons href="{{route('admin.estados.gerentes-mercado.index', $estado->id)}}"/>
        </form>
    </x-div-form-create-edit>

@endsection
