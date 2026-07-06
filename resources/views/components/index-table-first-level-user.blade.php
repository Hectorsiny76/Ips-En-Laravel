@props(['selectedEst' => null])

<x-index-div-table class="border-transparent rounded-tr-md rounded-tl-md">
    <x-index-div-table-thead-user :primary="false">
        <x-index-div-table-thead-th-column-user>Numero</x-index-div-table-thead-th-column-user>
        <x-index-div-table-thead-th-column-user>Nombre</x-index-div-table-thead-th-column-user>
        <x-index-div-table-thead-th-column-user>IP</x-index-div-table-thead-th-column-user>
        @if($selectedEst->centrodecostos != null)
            <x-index-div-table-thead-th-column-user>Centro de Costos</x-index-div-table-thead-th-column-user>
        @endif
    </x-index-div-table-thead-user>
    <x-index-div-table-tbody>
        <tr>
            <x-index-div-table-tbody-tr-td>{{$selectedEst->numero}}</x-index-div-table-tbody-tr-td>
            <x-index-div-table-tbody-tr-td>{{$selectedEst->nombre}}</x-index-div-table-tbody-tr-td>
            <x-index-div-table-tbody-tr-td :copy="true" @click="$copy('{{$selectedEst->idred}}')">{{$selectedEst->idred}}</x-index-div-table-tbody-tr-td>
            @if($selectedEst->centrodecostos != null)
                <x-index-div-table-tbody-tr-td>{{$selectedEst->centrodecostos}}</x-index-div-table-tbody-tr-td>
            @endif
        </tr>
    </x-index-div-table-tbody>
</x-index-div-table>
