@extends('admin_layout.master')

@section('title', 'Mercado ' . $mercado->numero)

@section('page-title', 'Mercado ' . $mercado->numero)

@section('content')

    <x-nav-ol-first href="{{ route('admin.estados.index') }}" nombre="Estados">
        <x-nav-ol-li-component href="{{ route('admin.estados.gerentes-mercado.index', $mercado->mercadogerente->estado) }}">
            Gerentes de Mercado de {{$mercado->mercadogerente->estado->nombre}}
        </x-nav-ol-li-component>
    </x-nav-ol-first>

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>Numero de Mercado</x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>Gerente de Mercado</x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>Tipo de Establecimiento</x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>Asociados Relacionados</x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            <tr>
                <td>
                    {{$mercado->numero}}
                </td>
                <td>
                    {{$mercado->mercadogerente->nombre}}
                </td>
                <td>
                    {{$mercado->establecimientotipo->nombre}}
                </td>
                <td>
                    {{$mercado->encargados_count}}
                </td>
                <x-table-td-actions
                    ahref="{{route('admin.mercados.edit', $mercado->id)}}"
                    formaction="{{ route('admin.mercados.destroy', $mercado->id) }}"
                    formconfirm="¿Está seguro que desea eliminar este mercado?"
                    />
                <x-table-td-fd-routing href="{{ route('admin.mercados.campos.index', $mercado->id) }}">Campos</x-table-td-fd-routing>
            </tr>
        </x-index-div-table-tbody>
    </x-index-div-table>
@endsection

