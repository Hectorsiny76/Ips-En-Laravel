
@extends('admin_layout.master')

@section('title', 'Tipos de archivo')

@section('page-title', 'Tipos de archivo')

@section('content')

    <x-div-index-title-create-button
        title="Estos son los tipos de archivo disponibles"
        url="{{route('admin.archivo-tipo.create')}}"
        button="Agregar un nuevo tipo de archivo"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Nombre
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Es Link
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Extensiones Permitidas
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Tamaño máximo en KB
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($archivotipos as $archivotipo)
                <tr>
                    <td>
                        {{$archivotipo->nombre}}
                    </td>
                    <td>
                        @if($archivotipo->es_link)
                            Sí
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        {{$archivotipo->mimes_permitidos}}
                    </td>
                    <td>
                        {{$archivotipo->tam_max_kb}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.archivo-tipo.edit', $archivotipo->id)}}"
                        formaction="{{ route('admin.archivo-tipo.destroy', $archivotipo->id) }}"
                        formconfirm="¿Esta seguro de eliminar este tipo de archivo?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

