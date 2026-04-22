<x-input-form-label for="tiendaformato">Formato de tienda</x-input-form-label>

<x-input-form-select name="tiendaformato_id" id="tiendaformato" initialvalue="-- Escoje un formato de tienda --">
    @foreach($tiendaformatos as $tiendaformato)
        <option value="{{$tiendaformato->id}}">{{$tiendaformato->nombre}}</option>
    @endforeach
</x-input-form-select>

<x-input-form-label for="tidelprograma">Programas Tidel Disponibles</x-input-form-label>

<x-input-form-select name="tidelprograma_id" id="tidelprograma" initialvalue="-- TIDEL Disponibles --">
    @foreach($tidelprogramas as $id => $ip)
        <option value="{{$id}}">{{$ip}}</option>
    @endforeach
</x-input-form-select>

<x-input-form-label for="cluster">Cluster</x-input-form-label>

<x-input-form-select name="cluster_id" id="cluster" initialvalue="-- Clusters --">
    @foreach($clusters as $cluster)
        <option value="{{$cluster->id}}">{{$cluster->nombre}}</option>
    @endforeach
</x-input-form-select>
