@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-form-page-header
            title="Registrar Denuncia"
            :backRoute="'citizen.complaints.index'"
        />

        <form
            method="POST"
            action="{{ route('citizen.complaints.store') }}"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="card p-4">

                <div class="row">

                    <div class="col-lg-6 mb-3">

                        <label>Descripción</label>

                        <textarea
                            name="description"
                            class="form-control"
                            required
                        ></textarea>

                    </div>

                    <div class="col-lg-6 mb-3">

                        <label>Tamaño del basurero</label>

                        <select name="dump_size" class="form-select">

                            <option value="pequeño">Pequeño</option>
                            <option value="mediano">Mediano</option>
                            <option value="grande">Grande</option>

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

                        <label>Foto del basurero</label>

                        <input
                            type="file"
                            name="photo"
                            class="form-control"
                            accept="image/*"
                        >

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
                cancelRoute="citizen.complaints.index"
                saveText="Registrar Denuncia"
            />

        </form>

    </div>

@endsection

@push('scripts')

    <script>

        let map = L.map('map').setView([14.91, -91.36], 13);

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
