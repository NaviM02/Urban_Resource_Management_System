@extends('layouts.app')

@section('content')

    <x-detail-page-header
        title="Recolección"
        itemName="Recolección {{ $collection->scheduled_date }}"
        description="Detalle de la recolección"
        backRoute="collections.index"
    />

    <div class="row g-3">

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    Información
                </div>

                <div class="card-body">

                    <p><strong>Ruta:</strong> {{ $collection->route->name }}</p>

                    <p><strong>Camión:</strong> {{ $collection->truck->plate }}</p>

                    <p><strong>Fecha:</strong> {{ $collection->scheduled_date }}</p>

                    <p>
                        <strong>Estado:</strong>

                        @if($collection->collection_status_id == 1)
                            <span class="badge bg-secondary">Programada</span>
                        @elseif($collection->collection_status_id == 2)
                            <span class="badge bg-primary">En proceso</span>
                        @elseif($collection->collection_status_id == 3)
                            <span class="badge bg-success">Completada</span>
                        @else
                            <span class="badge bg-danger">Incompleta</span>
                        @endif
                    </p>

                    <p><strong>Inicio:</strong> {{ $collection->started_at ?? '-' }}</p>

                    <p><strong>Fin:</strong> {{ $collection->finished_at ?? '-' }}</p>

                </div>

            </div>

            <div class="card mt-3 shadow-sm">

                <div class="card-header">
                    Resumen de recolección
                </div>

                <div class="card-body">

                    <p>
                        <strong>Puntos de recolección:</strong>
                        {{ $collection->points->count() }}
                    </p>

                    <p>
                        <strong>Basura estimada total:</strong>
                        {{ $collection->points->sum('estimated_kg') }} kg
                    </p>

                    <p>
                        <strong>Capacidad del camión:</strong>
                        {{ $collection->truck->capacity_tons * 1000 }} kg
                    </p>

                    @php
                        $total = $collection->points->sum('estimated_kg');
                        $capacity = $collection->truck->capacity_tons * 1000;
                    @endphp

                    <p>
                        <strong>Uso de capacidad:</strong>

                        @if($total > $capacity)
                            <span class="badge bg-danger">
                    Excede capacidad
                </span>
                        @else
                            <span class="badge bg-success">
                    Dentro de capacidad
                </span>
                        @endif

                    </p>

                </div>

            </div>


            @if($collection->collection_status_id == 1)

                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <form method="POST" action="{{ route('collections.start', $collection->id) }}">
                            @csrf
                            <button class="btn btn-success w-100">
                                <i class="bi bi-play"></i>
                                Iniciar recolección
                            </button>
                        </form>
                    </div>
                </div>

            @elseif($collection->collection_status_id == 2)

                <div class="card mt-3 shadow-sm">
                    <div class="d-flex gap-2 p-3">

                        <button
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#finishCollectionModal"
                        >
                            <i class="bi bi-check"></i>
                            Finalizar
                        </button>

                        <form method="POST" action="{{ route('collections.cancel', $collection->id) }}">
                            @csrf
                            <button class="btn btn-danger">
                                <i class="bi bi-x"></i>
                                Cancelar
                            </button>
                        </form>

                    </div>
                </div>

            @endif

        </div>

        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div id="map" style="height:500px;"></div>
                    <input
                        type="hidden"
                        id="path_coordinates"
                        value='@json($collection->route->path_coordinates ?? [])'
                    >

                </div>

            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="finishCollectionModal" tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form method="POST" action="{{ route('collections.finish', $collection->id) }}">

                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Finalizar recolección
                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">
                                Observaciones
                            </label>

                            <textarea
                                class="form-control"
                                name="observations"
                                rows="3"
                                placeholder="Escribe cualquier observación de la recolección..."
                            ></textarea>

                        </div>

                        <label class="form-label">
                            Incidencias
                        </label>

                        <table class="table" id="incidentsTable">

                            <thead>
                            <tr>
                                <th>Descripción</th>
                                <th width="80"></th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>

                        </table>

                        <button
                            type="button"
                            class="btn btn-sm btn-secondary"
                            onclick="addIncidentRow()"
                        >
                            <i class="bi bi-plus"></i>
                            Agregar incidencia
                        </button>

                    </div>

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Cancelar
                        </button>

                        <button class="btn btn-primary">
                            Finalizar recolección
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection

@push('scripts')

    <script>

        const map = L.map('map').setView([14.8347, -91.5184], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
            maxZoom:19
        }).addTo(map);

        // load map
        let savedCoordinates = document.getElementById('path_coordinates').value;

        if(savedCoordinates && savedCoordinates !== "[]"){

            try{

                let coords = JSON.parse(savedCoordinates);

                if(coords.length > 0){

                    let polyline = L.polyline(coords,{
                        color:'blue',
                        weight:5
                    }).addTo(map);

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

                    const wasteIcon = new L.Icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-grey.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                        iconSize: [15,26],
                        iconAnchor: [6,26],
                        popupAnchor: [1,-20],
                        shadowSize: [30,30]
                    });

                    L.marker(start,{icon:startIcon})
                        .addTo(map)
                        .bindPopup("Inicio de ruta");

                    L.marker(end,{icon:endIcon})
                        .addTo(map)
                        .bindPopup("Fin de ruta");

                    const points = @json($collection->points);

                    points.forEach(p => {

                        const lat = parseFloat(p.lat);
                        const lng = parseFloat(p.lng);

                        if(!isNaN(lat) && !isNaN(lng)){
                            L.marker([lat,lng],{icon:wasteIcon})
                                .addTo(map)
                                .bindPopup(`Basura estimada: ${p.estimated_kg} kg`);

                        }

                    });
                }

            }catch(e){
                console.error(e);
            }

        }

        // incidences
        function addIncidentRow(){

            const table = document
                .getElementById('incidentsTable')
                .getElementsByTagName('tbody')[0];

            const row = table.insertRow();

            row.innerHTML = `
                <td>
                    <input
                        type="text"
                        class="form-control"
                        name="incidents[]"
                        placeholder="Describe la incidencia..."
                    >
                </td>

                <td>
                    <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        onclick="this.closest('tr').remove()"
                    >
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
        }

    </script>

@endpush
