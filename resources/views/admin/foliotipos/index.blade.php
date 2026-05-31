
@extends('admin_layout.master')

@section('title', 'Tipos de Folios')

@section('page-title', 'Tipos de Folios')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los tipos de folio actuales"
        url="{{route('admin.foliotipos.create')}}"
        button="Agregar un nuevo tipo de folio"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                No
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Tipo
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Folios existentes
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column :routing="true"/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($foliotipos as $foliotipo)
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$foliotipo->tipo}}
                    </td>
                    <td>
                        {{$foliotipo->folios_count}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.foliotipos.edit', $foliotipo->id)}}"
                        formaction="{{ route('admin.foliotipos.destroy', $foliotipo->id) }}"
                        formconfirm="¿Esta seguro de eliminar este tipo de folio?"
                    />
                    <x-table-td-fd-routing href="{{route('admin.foliotipos.folios.index',$foliotipo->id)}}">Folios</x-table-td-fd-routing>
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

