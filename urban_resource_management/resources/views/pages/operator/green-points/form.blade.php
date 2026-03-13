@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-form-page-header
            title="{{ isset($greenPoint) ? 'Editar Punto Verde' : 'Crear Punto Verde' }}"
            :backRoute="'green-points.index'"
            :titleComplement="$greenPoint->name ?? null"
        />

        <form
            method="POST"
            action="{{ isset($greenPoint) ? route('green-points.update',$greenPoint->id) : route('green-points.store') }}"
        >

            @csrf
            @if(isset($greenPoint))
                @method('PUT')
            @endif

            <div class="card p-4">

                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <x-toggle-switch
                            name="status_id"
                            :checked="!isset($greenPoint) || $greenPoint->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                            checkedLabel="Activo"
                            uncheckedLabel="Inactivo"
                        />
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-6 mb-3">
                        <label>Nombre</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name',$greenPoint->name ?? '') }}"
                            required
                        >
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label>Encargado</label>

                        <select name="manager_user_id" class="form-select">

                            <option value="">Seleccionar</option>

                            @foreach($managers as $manager)

                                <option value="{{ $manager->id }}"
                                    @selected(old('manager_user_id',$greenPoint->manager_user_id ?? '') == $manager->id)>
                                    {{ $manager->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-6 mb-3">

                        <label>Dirección</label>

                        <div class="input-group">

                            <input
                                type="text"
                                id="address"
                                name="address"
                                class="form-control"
                                value="{{ old('address',$greenPoint->address ?? '') }}"
                                required
                            >

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="searchAddress()"
                            >
                                Buscar
                            </button>

                        </div>

                    </div>

                    <div class="col-lg-6 mb-3">
                        <label>Capacidad en metros cubicos</label>
                        <input
                            type="number"
                            name="capacity_m3"
                            class="form-control"
                            value="{{ old('capacity_m3',$greenPoint->capacity_m3 ?? '') }}"
                            required
                        >
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-3 mb-3">
                        <label>Hora apertura</label>
                        <input type="time" name="open_time" class="form-control"
                               value="{{ old('open_time',$greenPoint->open_time ?? '') }}">
                    </div>

                    <div class="col-lg-3 mb-3">
                        <label>Hora cierre</label>
                        <input type="time" name="close_time" class="form-control"
                               value="{{ old('close_time',$greenPoint->close_time ?? '') }}">
                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-3 mb-3">
                        <label>Latitud</label>
                        <input
                            type="text"
                            name="lat"
                            id="lat"
                            class="form-control"
                            value="{{ old('lat',$greenPoint->lat ?? '') }}"
                            readonly
                        >
                    </div>

                    <div class="col-lg-3 mb-3">
                        <label>Longitud</label>
                        <input
                            type="text"
                            name="lng"
                            id="lng"
                            class="form-control"
                            value="{{ old('lng',$greenPoint->lng ?? '') }}"
                            readonly
                        >
                    </div>

                </div>

                <div class="mt-3">

                    <label>Ubicación en el mapa</label>

                    <div id="map" style="height:450px;"></div>

                </div>

            </div>

            <x-form-actions
                cancelRoute="green-points.index"
                :showDelete="isset($greenPoint)"
                :saveText="isset($greenPoint) ? 'Actualizar' : 'Crear'"
            />

        </form>

    </div>

@endsection


@push('scripts')

    <script>

        let map = L.map('map').setView([14.911, -91.361], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{
            maxZoom:19
        }).addTo(map);

        const greenIcon = new L.Icon({
            iconUrl:'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
            shadowUrl:'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize:[25,41],
            iconAnchor:[12,41],
            popupAnchor:[1,-34],
            shadowSize:[41,41]
        });

        let marker = null;

        // click map
        map.on('click', function(e){

            setMarker(e.latlng.lat, e.latlng.lng);

        });

        function setMarker(lat,lng){

            if(marker){
                map.removeLayer(marker);
            }

            marker = L.marker([lat,lng],{icon:greenIcon}).addTo(map);

            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

        }

        // search address
        function searchAddress(){

            let address = document.getElementById('address').value;

            if(!address) return;

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
                .then(res=>res.json())
                .then(data=>{

                    if(data.length > 0){

                        let lat = data[0].lat;
                        let lon = data[0].lon;

                        map.setView([lat,lon],16);

                        setMarker(lat,lon);

                    }

                });

        }

        // load existing point
        let lat = document.getElementById('lat').value;
        let lng = document.getElementById('lng').value;

        if(lat && lng){

            map.setView([lat,lng],16);

            setMarker(lat,lng);

        }

    </script>

@endpush
