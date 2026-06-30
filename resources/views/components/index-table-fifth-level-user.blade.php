@props(['selectedEst' => null])

<x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
    <x-index-div-table-thead-user>
        <x-index-div-table-thead-th-column-user>Tipo de Caja</x-index-div-table-thead-th-column-user>
        <x-index-div-table-thead-th-column-user>Número</x-index-div-table-thead-th-column-user>
    </x-index-div-table-thead-user>
    <x-index-div-table-tbody>
        @foreach($selectedEst->cajatipoestablecimiento as $caja)
            <tr>
                <x-index-div-table-tbody-tr-td>{{$caja->cajatipo->nombre}}</x-index-div-table-tbody-tr-td>
                <x-index-div-table-tbody-tr-td>{{$caja->numcaja}}</x-index-div-table-tbody-tr-td>
            </tr>
        @endforeach
    </x-index-div-table-tbody>
</x-index-div-table>
