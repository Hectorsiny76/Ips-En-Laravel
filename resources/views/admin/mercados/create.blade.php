@extends('admin_layout.master')

@section('title', 'Crear Mercado')

@section('page-title', 'Crear un Nuevo Mercado para '.$mercadoGerente->nombre)

@section('content')

    <x-div-edit-create-title>Agrega un mercado nuevo</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.gerentes-mercado.mercados.store', $mercadoGerente->id)}}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-form-label for="nombre">Número</x-input-form-label>

                <x-input-form
                    type="number"
                    name="numero"
                    placeholder="601"
                    value="{{old('numero')}}"
                    min="1"
                    step="1"
                    required
                />

                <x-input-form-label for="Gerente de mercado">Gerente de Mercado</x-input-form-label>

                <x-input-form
                    type="text"
                    name="Gerente de mercado"
                    value="{{$mercadoGerente->nombre}}"
                    readonly
                />

                <x-input-form-label for="establecimientotipo_id">Tipo de establecimiento</x-input-form-label>

                <x-input-form-select name="establecimientotipo_id" id="establecimientotipo_id" initialvalue="-- Escoje un tipo de establecimiento --" :required="true">
                    @foreach($estTipos as $estTipo)
                        <option value="{{$estTipo->id}}">{{$estTipo->nombre}}</option>
                    @endforeach
                </x-input-form-select>

            </div>

            <livewire:admin::livewire.mercados.search-managers-mercado/>

            <x-form-create-buttons href="{{route('admin.estados.gerentes-mercado.index', $mercadoGerente->estado->id)}}"/>

        </form>
    </x-div-form-create-edit>

@endsection
