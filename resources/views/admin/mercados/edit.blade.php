@extends('admin_layout.master')

@section('title', 'Editar Mercado')

@section('page-title', 'Editar mercado '.$mercado->numero.' del gerente '.$mercado->mercadogerente->nombre)

@section('content')

    <x-div-edit-create-title>Editar mercado {{$mercado->numero}}</x-div-edit-create-title>

    <x-div-form-create-edit>
        <x-form-errors/>
        <form action="{{route('admin.mercados.update', $mercado->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-form-label for="nombre">Número</x-input-form-label>

                <x-input-form
                    type="number"
                    name="numero"
                    placeholder="601"
                    value="{{old('numero', $mercado->numero)}}"
                    min="1"
                    step="1"
                    required
                />

                <x-input-form-label for="Gerente de mercado">Gerente de Mercado</x-input-form-label>

                <x-input-form
                    type="text"
                    name="Gerente de Mercado"
                    value="{{$mercado->mercadogerente->nombre}}"
                    readonly
                />

                <x-input-form-label for="establecimientotipo_id">Tipo de establecimiento</x-input-form-label>

                <x-input-form-select name="establecimientotipo_id" id="establecimientotipo_id" initialvalue="-- Escoje un tipo de establecimiento --" :required="true">
                    @foreach($estTipos as $estTipo)
                        <option value="{{$estTipo->id}}" @selected(old('establecimientotipo_id', $mercado->establecimientotipo->id ?? '') == $estTipo->id)>{{$estTipo->nombre}}</option>
                    @endforeach
                </x-input-form-select>

            </div>

            @livewire('admin::livewire.mercados.search-managers-mercado', ['mercado' => $mercado])

            <x-form-update-buttons href="{{route('admin.gerentes-mercado.mercados.index', $mercado->mercadogerente->id)}}"/>

        </form>
    </x-div-form-create-edit>

@endsection
