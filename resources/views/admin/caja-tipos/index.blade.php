
@extends('admin_layout.master')

@section('title', 'Tipos de POS')

@section('page-title', 'Tipos de POS')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los Tipos de Caja actuales"
        url="{{route('admin.caja-tipos.create')}}"
        button="Agregar un nuevo tipo de caja"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                No
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Nombre
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Establecimientos relacionados
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($cajatipos as $cajatipo)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$cajatipo->nombre}}
                    </td>
                    <td>
                        {{$cajatipo->establecimientos_count}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.caja-tipos.edit', $cajatipo->id)}}"
                        formaction="{{ route('admin.caja-tipos.destroy', $cajatipo->id) }}"
                        formconfirm="¿Esta seguro de eliminar esta duo de establecimientos de la lista?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

