

@extends('admin_layout.master')

@section('title', 'Editar al gerente de mercado '.$mercadoGerente->nombre)

@section('page-title', 'Editar al gerente de mercado '.$mercadoGerente->nombre)

@section('content')

    <x-div-edit-create-title>Editar al gerente de mercado {{$mercadoGerente->nombre}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <form action="{{route('admin.gerentes-mercado.update', $mercadoGerente->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Nombre</x-input-form-label>

                <x-input-form
                    type="text"
                    name="nombre"
                    placeholder="Mr. Smith"
                    value="{{old('nombre', $mercadoGerente->nombre)}}"
                    required
                />
            </div>

            <x-form-update-buttons href="{{route('admin.estados.gerentes-mercado.index', $mercadoGerente->estado_id)}}"/>
        </form>
    </x-div-form-create-edit>

@endsection
