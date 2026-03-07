@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-form-page-header
            title="{{ isset($route) ? 'Editar Ruta' : 'Crear Ruta' }}"
            :backRoute="'routes.index'"
            :titleComplement="$route->name ?? null"
        />

        <form
            method="POST"
            action="{{ isset($route) ? route('routes.update',$route->id) : route('routes.store') }}"
            class="d-flex flex-column flex-grow-1"
        >

            @csrf

            @if(isset($route))
                @method('PUT')
            @endif

            <div class="card p-4 flex-grow-1">

                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <x-toggle-switch
                            name="status_id"
                            :checked="!isset($route) || $route->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                            checkedLabel="Activo"
                            uncheckedLabel="Inactivo"
                        />
                    </div>
                </div>

                <div class="row">

                    <div class="col-12 col-lg-6 mb-3">
                        <label>Nombre</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name',$route->name ?? '') }}"
                            required
                        >
                    </div>

                    <div class="col-12 col-lg-3 mb-3">
                        <label>Zona</label>
                        <select name="zone_id" class="form-select" required>

                            @foreach($zones as $zone)

                                <option value="{{ $zone->id }}"
                                    @selected(old('zone_id', $route->zone_id ?? '') == $zone->id)>

                                    {{ $zone->name }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-12 col-lg-3 mb-3">
                        <label>Tipo de residuo</label>

                        <select name="waste_type_id" class="form-select" required>

                            @foreach($wasteTypes as $type)

                                <option value="{{ $type->id }}"
                                    @selected(old('waste_type_id', $route->waste_type_id ?? '') == $type->id)>

                                    {{ $type->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="row">

                    <div class="col-12 col-lg-6 mb-3">

                        <label class="mb-2">Días de recolección</label>

                        <div class="d-flex gap-3 flex-wrap">

                            <label><input type="checkbox" class="day-checkbox" value="0"> Lunes</label>
                            <label><input type="checkbox" class="day-checkbox" value="1"> Martes</label>
                            <label><input type="checkbox" class="day-checkbox" value="2"> Miércoles</label>
                            <label><input type="checkbox" class="day-checkbox" value="3"> Jueves</label>
                            <label><input type="checkbox" class="day-checkbox" value="4"> Viernes</label>
                            <label><input type="checkbox" class="day-checkbox" value="5"> Sábado</label>
                            <label><input type="checkbox" class="day-checkbox" value="6"> Domingo</label>

                        </div>

                        <input
                            type="hidden"
                            name="collection_days"
                            id="collection_days"
                            value="{{ old('collection_days',$route->collection_days ?? '0000000') }}"
                        >
                    </div>



                    <div class="col-12 col-lg-3 mb-3">
                        <label>Hora inicio</label>

                        <input
                            type="time"
                            name="start_time"
                            class="form-control"
                            value="{{ old('start_time', $route->start_time ?? '') }}"
                            required
                        >
                    </div>

                    <div class="col-12 col-lg-3 mb-3">
                        <label>Hora fin</label>

                        <input
                            type="time"
                            name="end_time"
                            class="form-control"
                            value="{{ old('end_time', $route->end_time ?? '') }}"
                            required
                        >
                    </div>
                </div>

                <div class="row">

                    <div class="col-12 col-lg-3 mb-3">
                        <label>Distancia (km)</label>

                        <input
                            type="number"
                            step="0.01"
                            name="distance_km"
                            id="distance"
                            class="form-control"
                            value="{{ old('distance_km',$route->distance_km ?? '') }}"
                            readonly
                        >

                    </div>

                </div>

                <div class="mb-3">

                    <label>Ruta en el mapa</label>

                    <div id="map" style="height: 450px;"></div>

                </div>

                <input
                    type="hidden"
                    name="path_coordinates"
                    id="path_coordinates"
                    value='{{ old("path_coordinates", json_encode($route->path_coordinates ?? [])) }}'
                >

            </div>

            <div class="mt-auto">
                <x-form-actions
                    cancelRoute="routes.index"
                    :showDelete="isset($route)"
                    :saveText="isset($route) ? 'Actualizar' : 'Crear'"
                />
            </div>

        </form>

    </div>

@endsection

@push('scripts')

    <script>

        let map = L.map('map').setView([14.911, -91.361], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        let drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        let drawControl = new L.Control.Draw({
            draw: {
                polygon:false,
                rectangle:false,
                circle:false,
                marker:false,
                circlemarker:false,
                polyline:true
            },
            edit:{
                featureGroup: drawnItems
            }
        });

        map.addControl(drawControl);

        // save route
        map.on(L.Draw.Event.CREATED, function (event) {

            let layer = event.layer;

            drawnItems.clearLayers();

            drawnItems.addLayer(layer);

            saveCoordinates(layer);

        });

        // save coordinates
        function saveCoordinates(layer){

            let coords = layer.getLatLngs().map(p => [p.lat, p.lng]);

            document.getElementById('path_coordinates').value =
                JSON.stringify(coords);

            calculateDistance(coords);

        }

        // calculate distance
        function calculateDistance(points){

            let total = 0;

            for(let i=1;i<points.length;i++){

                total += map.distance(points[i-1], points[i]);

            }

            document.getElementById('distance').value =
                (total/1000).toFixed(2);

        }

        // for string days
        const dayCheckboxes = document.querySelectorAll('.day-checkbox');
        const daysInput = document.getElementById('collection_days');

        function updateCollectionDays(){

            let days = ['0','0','0','0','0','0','0'];

            dayCheckboxes.forEach(cb => {

                if(cb.checked){
                    days[cb.value] = '1';
                }

            });

            daysInput.value = days.join('');
        }

        dayCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateCollectionDays);
        });

        // load days
        const savedDays = document.getElementById('collection_days').value;

        if(savedDays){

            const checkboxes = document.querySelectorAll('.day-checkbox');

            checkboxes.forEach(cb => {

                const index = parseInt(cb.value);

                if(savedDays[index] === '1'){
                    cb.checked = true;
                }

            });

        }

        // load map
        let savedCoordinates = document.getElementById('path_coordinates').value;

        if(savedCoordinates && savedCoordinates !== "[]"){

            try{

                let coords = JSON.parse(savedCoordinates);

                if(coords.length > 0){

                    let polyline = L.polyline(coords,{color:'blue'});

                    drawnItems.addLayer(polyline);

                    map.fitBounds(polyline.getBounds());

                    calculateDistance(coords);

                }

            }catch(e){
                console.error(e);
            }

        }

        // edit route
        map.on('draw:edited', function (e) {

            e.layers.eachLayer(function(layer){

                saveCoordinates(layer);

            });

        });

    </script>

@endpush
