@extends('admin_layout.master')

@section('title', 'Establecimientos del Campo '.$campogerente->campo->numero)

@section('page-title', 'Establecimientos del Campo '.$campogerente->campo->numero)

@section('content')

    <x-nav-ol-first href="{{route('admin.estados.index')}}" nombre="Estados">

        <x-nav-ol-li-component
            href="{{ route('admin.estados.gerentes-mercado.index', $campogerente->campo->mercado->mercadogerente->estado) }}">
            Gerentes de mercado de {{ $campogerente->campo->mercado->mercadogerente->estado->nombre }}
        </x-nav-ol-li-component>

        <x-nav-ol-li-component
            href="{{ route('admin.gerentes-mercado.mercados.index', $campogerente->campo->mercado->mercadogerente->id) }}">
            Mercado {{ $campogerente->campo->mercado->numero }} ({{$campogerente->campo->mercado->establecimientotipo->nombre}})
        </x-nav-ol-li-component>

        <x-nav-ol-li-component
            href="{{ route('admin.mercados.campos.index', $campogerente->campo->mercado->id) }}">
            Campos del mercado {{ $campogerente->campo->mercado->numero }}
        </x-nav-ol-li-component>

        <x-nav-ol-li-component
            href="{{route('admin.campo.campo-gerente.index', $campogerente->campo->id)}}">
            Gerente de Campo {{$campogerente->nombre}}
        </x-nav-ol-li-component>

    </x-nav-ol-first>
    <x-div-index-title-create-button
        title="Estos son los establecimientos de {{$campogerente->nombre}}"
        url="{{route('admin.campo-gerente.establecimientos.create', $campogerente->id)}}"
        button="Agregar un nuevo establecimiento"
    />

        <x-index-div-table>
            <x-index-div-table-thead>
                @foreach($columnas as $columna)
                    <x-index-div-table-thead-th-column>{{$columna}}</x-index-div-table-thead-th-column>
                @endforeach
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
            @foreach($establecimientos as $establecimiento)
                <tr>
                    @foreach($columnasDb as $columnaDb)
                        <td>{{data_get($establecimiento, $columnaDb) ?? 'N/A'}}</td>
                    @endforeach
                    <x-table-td-actions
                        ahref="{{route('admin.establecimientos.edit', $establecimiento->id)}}"
                        formaction="{{route('admin.establecimientos.destroy', $establecimiento->id)}}"
                        formconfirm="¿Esta seguro de que desea eliminar este establecimiento?"
                    />
                </tr>
            @endforeach
            </x-index-div-table-tbody>
        </x-index-div-table>

@endsection
