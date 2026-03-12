@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-form-page-header
            title="Programar Recolección"
            :backRoute="'collections.index'"
        />

        <form method="POST" action="{{ route('collections.store') }}" class="d-flex flex-column flex-grow-1">

            @csrf

            <div class="card p-4 flex-grow-1">

                <div class="row">

                    <div class="col-12 col-lg-4 mb-3">

                        <label>Ruta</label>

                        <select name="route_id" class="form-select" required>

                            @foreach($routes as $route)

                                <option
                                    value="{{ $route->id }}"
                                    data-coords='@json($route->path_coordinates)'
                                    data-days="{{ $route->collection_days_text }}"
                                >
                                    {{ $route->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-12 col-lg-4 mb-3">

                        <label>Camión</label>

                        <select name="truck_id" class="form-select" required>

                            @foreach($trucks as $truck)

                                <option value="{{ $truck->id }}">
                                    {{ $truck->plate }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-12 col-lg-2 mb-3">

                        <label>Fecha inicio</label>

                        <input
                            type="date"
                            name="scheduled_date"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-12 col-lg-2 mb-3">

                        <label>Semanas</label>

                        <input
                            type="number"
                            name="weeks"
                            class="form-control"
                            min="1"
                            max="12"
                            value="1"
                            required
                        >

                    </div>

                    <div class="col-12 mb-3">

                        <small class="text-muted">
                            Días de recolección:
                            <span id="routeDays">Seleccione una ruta</span>
                        </small>

                    </div>

                </div>

                <div class="mt-4">

                    <label class="mb-2">Ruta en el mapa</label>

                    <div id="map" style="height:400px;"></div>

                </div>

            </div>

            <div class="mt-auto">

                <x-form-actions
                    cancelRoute="collections.index"
                    saveText="Programar"
                />

            </div>

        </form>

    </div>

@endsection

@push('scripts')
    <script>

        let map = L.map('map').setView([14.911, -91.361], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        let currentPolyline = null;
        let startMarker = null;
        let endMarker = null;

        let routeSelect = document.querySelector('select[name="route_id"]');

        function updateRouteMap(){

            let selected = routeSelect.options[routeSelect.selectedIndex];

            let coords = selected.dataset.coords;
            let days = selected.dataset.days;

            document.getElementById('routeDays').innerText = days ?? "No definido";

            if(!coords) return;

            try{

                coords = JSON.parse(coords);

                if(currentPolyline){
                    map.removeLayer(currentPolyline);
                }

                if(startMarker){
                    map.removeLayer(startMarker);
                }

                if(endMarker){
                    map.removeLayer(endMarker);
                }

                if(coords.length > 0){

                    currentPolyline = L.polyline(coords,{color:'blue'}).addTo(map);

                    map.fitBounds(currentPolyline.getBounds());

                    let start = coords[0];
                    let end = coords[coords.length - 1];

                    const startIcon = new L.Icon({
                        iconUrl:'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                        shadowUrl:'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                        iconSize:[25,41],
                        iconAnchor:[12,41]
                    });

                    const endIcon = new L.Icon({
                        iconUrl:'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                        shadowUrl:'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                        iconSize:[25,41],
                        iconAnchor:[12,41]
                    });

                    startMarker = L.marker(start,{icon:startIcon}).addTo(map);
                    endMarker = L.marker(end,{icon:endIcon}).addTo(map);

                }

            }catch(e){
                console.error(e);
            }
        }

        routeSelect.addEventListener('change', updateRouteMap);

        updateRouteMap();

    </script>
@endpush
