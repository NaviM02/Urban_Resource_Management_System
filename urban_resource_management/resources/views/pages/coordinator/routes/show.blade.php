@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-detail-page-header
            itemName="{{ $route->name }}"
            description="Detalle de la ruta"
            backRoute="routes.index"
            editRoute="routes.edit"
            :editParams="[$route->id]"
        />

        <div class="card p-4">

            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <x-toggle-switch
                        name="status_id"
                        :checked="$route->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                        disabled="true"
                        checkedLabel="Activo"
                        uncheckedLabel="Inactivo"
                    />
                </div>
            </div>

            <div class="row">

                <x-show-field
                    label="Nombre"
                    :value="$route->name"
                />

                <x-show-field
                    label="Zona"
                    :value="$route->zone->name"
                />

            </div>

            <div class="row">

                <x-show-field
                    label="Tipo de residuo"
                    :value="$route->wasteType->name"
                />

                <x-show-field
                    label="Distancia (km)"
                    :value="$route->distance_km"
                />

            </div>

            <div class="row">

                <x-show-field
                    label="Hora inicio"
                    :value="$route->start_time"
                />

                <x-show-field
                    label="Hora fin"
                    :value="$route->end_time"
                />

            </div>

            <div class="row">

                <x-show-field
                    label="Días de recolección"
                    :value="$route->collection_days_text"
                />

            </div>

            <div class="mt-4">

                <label class="mb-2">Ruta en el mapa</label>

                <div id="map" style="height:450px;"></div>

            </div>

            <input
                type="hidden"
                id="path_coordinates"
                value='{{ json_encode($route->path_coordinates ?? []) }}'
            >

        </div>

    </div>

@endsection

@push('scripts')

    <script>

        let map = L.map('map', {
            dragging: false,
            zoomControl: false,
            scrollWheelZoom: false,
            doubleClickZoom: false,
            boxZoom: false,
            keyboard: false,
            tap: false
        }).setView([14.911, -91.361], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // laod map
        let savedCoordinates = document.getElementById('path_coordinates').value;

        if(savedCoordinates && savedCoordinates !== "[]"){

            try{

                let coords = JSON.parse(savedCoordinates);

                if(coords.length > 0){

                    let polyline = L.polyline(coords,{color:'blue'}).addTo(map);

                    map.fitBounds(polyline.getBounds());

                    let start = coords[0];

                    let end = coords[coords.length - 1];

                    const startIcon = new L.Icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                        iconSize: [25,41],
                        iconAnchor: [12,41],
                        popupAnchor: [1,-34],
                        shadowSize: [41,41]
                    });

                    const endIcon = new L.Icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                        iconSize: [25,41],
                        iconAnchor: [12,41],
                        popupAnchor: [1,-34],
                        shadowSize: [41,41]
                    });

                    L.marker(start,{icon:startIcon}).addTo(map)
                        .bindPopup("Inicio de ruta");

                    L.marker(end,{icon:endIcon}).addTo(map)
                        .bindPopup("Fin de ruta");

                }

            }catch(e){
                console.error(e);
            }

        }

    </script>

@endpush
