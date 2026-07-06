@props(['$selectedEst' => null])

<x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
    <x-index-div-table-thead-user :primary="false">
        <x-index-div-table-thead-th-column-user>Gerente de Campo</x-index-div-table-thead-th-column-user>
        <x-index-div-table-thead-th-column-user>Campo</x-index-div-table-thead-th-column-user>
        <x-index-div-table-thead-th-column-user>Mercado</x-index-div-table-thead-th-column-user>
        <x-index-div-table-thead-th-column-user>Gerente de Mercado</x-index-div-table-thead-th-column-user>
        <x-index-div-table-thead-th-column-user>Estado</x-index-div-table-thead-th-column-user>
    </x-index-div-table-thead-user>
    <x-index-div-table-tbody>
        <tr>
            <x-index-div-table-tbody-tr-td>{{$selectedEst->campogerente->nombre ?? ''}}</x-index-div-table-tbody-tr-td>
            <x-index-div-table-tbody-tr-td>{{$selectedEst->campo->numero ?? ''}}</x-index-div-table-tbody-tr-td>
            <x-index-div-table-tbody-tr-td>{{$selectedEst->mercado->numero ?? ''}}</x-index-div-table-tbody-tr-td>
            <x-index-div-table-tbody-tr-td>{{$selectedEst->mercadogerente->nombre ?? ''}}</x-index-div-table-tbody-tr-td>
            <x-index-div-table-tbody-tr-td>{{$selectedEst->estado->nombre ?? ''}}</x-index-div-table-tbody-tr-td>
        </tr>
    </x-index-div-table-tbody>
</x-index-div-table>
