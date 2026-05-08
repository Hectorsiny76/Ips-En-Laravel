@extends('admin_layout.master')

@section('title', 'Folios Tipo'.$folioTipo->tipo)

@section('page-title', 'Folios Tipo'.$folioTipo->tipo)

@section('content')

    <x-nav-ol-first href="{{route('admin.foliotipos.index')}}" nombre="Tipos de Folios"/>

    <x-div-index-title-create-button
        title="Folios Tipo {{$folioTipo->tipo}} actuales"
        url="{{route('admin.foliotipos.folios.create', $folioTipo->id)}}"
        button="Agregar un nuevo {{$folioTipo->tipo}}"
    />

    <x-index-div-table>
        <x-index-div-table-thead>
            <x-index-div-table-thead-th-column>
                Numero
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Titulo
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-column>
                Descripcion
            </x-index-div-table-thead-th-column>
            <x-index-div-table-thead-th-actions-column/>
        </x-index-div-table-thead>
        <x-index-div-table-tbody>
            @foreach($folios as $folio)
                <tr>
                    <td>
                        {{$folio->numero}}
                    </td>
                    <td>
                        {{$folio->titulo}}
                    </td>
                    <td>
                        {{$folio->descripcion}}
                    </td>
                    <x-table-td-actions
                        ahref="{{route('admin.folios.edit', $folio->id)}}"
                        formaction="{{ route('admin.folios.destroy', $folio->id) }}"
                        formconfirm="¿Esta seguro de eliminar este folio?"
                    />
                </tr>
            @endforeach
        </x-index-div-table-tbody>
    </x-index-div-table>

@endsection

