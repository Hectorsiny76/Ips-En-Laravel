@extends('admin_layout.master')

@section('title', 'Gerente Campo ' . $campo->campogerente->nombre)

@section('page-title', 'Gerente Campo ' . $campo->campogerente->nombre)

@section('content')

    <x-nav-ol-first href="{{route('admin.estados.index')}}" nombre="Estados">

        <x-nav-ol-li-component href="{{ route('admin.gerentes-mercado.mercados.index', $campo->mercado->mercadogerente->id) }}">
            Gerentes de mercado de {{ $campo->mercado->mercadogerente->estado->nombre }}
        </x-nav-ol-li-component>

        <x-nav-ol-li-component href="{{ route('admin.estados.gerentes-mercado.index', $campo->mercado->mercadogerente->estado->id) }}">
            Mercado {{ $campo->mercado->numero }} ({{$campo->mercado->establecimientotipo->nombre}})
        </x-nav-ol-li-component>

        <x-nav-ol-li-component href="{{ route('admin.mercados.campos.index', $campo->mercado->id) }}">
            Campos del mercado {{ $campo->mercado->numero }}
        </x-nav-ol-li-component>

    </x-nav-ol-first>

    <x-index-div-table>
            <x-index-div-table-thead>
                <tr>
                    <x-index-div-table-thead-th-column>
                        Nombre
                    </x-index-div-table-thead-th-column>
                    <x-index-div-table-thead-th-column>
                        Teléfono
                    </x-index-div-table-thead-th-column>
                    <x-index-div-table-thead-th-column>
                        Correo
                    </x-index-div-table-thead-th-column>
                    <x-index-div-table-thead-th-column>
                        Campo
                    </x-index-div-table-thead-th-column>
                    <x-index-div-table-thead-th-actions-column :routing="true"/>
                </tr>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
            <tr>
                <td>
                    {{$campo->campogerente->nombre}}
                </td>
                <td>
                    {{$campo->campogerente->tel}}
                </td>
                <td>
                    {{$campo->campogerente->correo}}
                </td>
                <td>
                    {{$campo->numero}}
                </td>
                <x-table-td-actions
                    ahref="{{ route('admin.campo-gerente.edit', $campo->campogerente->id) }}"
                    formaction="{{ route('admin.campo-gerente.destroy', $campo->campogerente->id) }}"
                    formconfirm="¿Está seguro de eliminar este gerente de campo?"
                    warning="¡Al eliminar este gerente de campo se eliminarán todos sus establecimientos relacionados!"
                    />
                <x-table-td-fd-routing href="{{ route('admin.campo-gerente.establecimientos.index', $campo->campogerente->id) }}">
                    Establecimientos
                </x-table-td-fd-routing>
            </tr>
            </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

