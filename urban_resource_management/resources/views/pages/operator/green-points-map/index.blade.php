@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-list-header
            title="Mapa de Puntos Verdes"
            description="Visualización de todos los puntos verdes"
        />

        <div class="card p-4">

            <div class="row mb-3">

                <div class="col-lg-4">

                    <label>Ir a punto verde</label>

                    <select id="pointSelector" class="form-select">

                        <option value="">Mostrar todos</option>

                        @foreach($greenPoints as $point)

                            <option
                                value="{{ $point->lat }},{{ $point->lng }}"
                            >
                                {{ $point->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <div id="map" style="height:600px;"></div>

        </div>

    </div>

@endsection

@push('scripts')

    <script>

        let map = L.map('map').setView([14.911,-91.361],13);

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

        let points = @json($greenPoints);

        points.forEach(point => {

            if(point.lat && point.lng){

                L.marker([point.lat,point.lng],{icon:greenIcon})
                    .addTo(map)
                    .bindPopup(`
<b>${point.name}</b><br>
${point.address}<br>
Capacidad: ${point.capacity_m3} m³
`);

            }

        });

        document.getElementById('pointSelector')
            .addEventListener('change', function(){

                let value = this.value;

                if(!value){
                    map.setView([14.911,-91.361],13);
                    return;
                }

                let coords = value.split(',');

                map.setView([coords[0],coords[1]],16);

            });

    </script>

@endpush
