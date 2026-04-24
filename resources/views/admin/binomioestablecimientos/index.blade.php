
@extends('admin_layout.master')

@section('title', 'Lista de Establecimientos Binomio')

@section('page-title', 'Lista de Establecimientos Binomio')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los establecimientos binomio actuales"
        url="{{route('admin.binomioestablecimientos.create')}}"
        button="Agregar un nuevo duo de establecimientos"
    />

    <x-index-div-table>
            <x-index-div-table-thead>
                <x-index-div-table-thead-th-column>
                    Fila
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Tienda
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    No. Tienda
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    Estación
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-column>
                    No. Estación
                </x-index-div-table-thead-th-column>
                <x-index-div-table-thead-th-actions-column/>
            </x-index-div-table-thead>
            <x-index-div-table-tbody>
            @foreach($estBinomios as $estBinomio)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$estBinomio->tienda->nombre}}
                    </td>
                    <td>
                        {{$estBinomio->tienda->numero}}
                    </td>
                    <td>
                        {{$estBinomio->estacion->nombre}}
                    </td>
                    <td>
                        {{$estBinomio->estacion->numero}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.binomioestablecimientos.edit', $estBinomio->id)}}"
                        formaction="{{ route('admin.binomioestablecimientos.destroy', $estBinomio->id) }}"
                        formconfirm="¿Esta seguro de eliminar esta duo de establecimientos de la lista?"
                    />
                </tr>
            @endforeach
            </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

