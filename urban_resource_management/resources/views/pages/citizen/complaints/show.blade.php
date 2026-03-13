@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-detail-page-header
            itemName="Denuncia: {{ $complaint->complaint_date }}"
            description="Detalle de la denuncia"
            backRoute="citizen.complaints.index"
        />

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Fecha:</strong><br>
                        {{ $complaint->complaint_date }}
                    </div>

                    <div class="col-md-6">
                        <strong>Estado:</strong><br>

                        @if($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::RECEIVE)
                            <span class="badge bg-secondary">Recibida</span>
                        @elseif($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::REVIEW)
                            <span class="badge bg-warning">En revisión</span>
                        @elseif($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::ASSIGNED)
                            <span class="badge bg-primary">Asignada</span>
                        @elseif($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::IN_PROGRESS)
                            <span class="badge bg-success">En atención</span>
                        @elseif($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::ATTENDED)
                            <span class="badge bg-success">Atendida</span>
                        @elseif($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::CLOSED)
                            <span class="badge bg-success">Cerrada</span>
                        @endif

                    </div>
                </div>


                <div class="row mb-3">

                    <div class="col-md-6">
                        <strong>Dirección</strong>
                        <p>{{ $complaint->address ?? 'No especificada' }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Tamaño del basurero</strong>
                        <p>{{ ucfirst($complaint->dump_size) }}</p>
                    </div>

                </div>

                <div class="mb-3">
                    <strong>Descripción</strong>
                    <p>{{ $complaint->description }}</p>
                </div>


                @if($complaint->photo_before || $complaint->photo_after)

                    <div class="mb-4">

                        <strong>Fotografías</strong>

                        <div class="row mt-2">

                            @if($complaint->photo_before)

                                <div class="col-md-6 text-center">

                                    <p class="text-muted mb-2">
                                        Antes
                                    </p>

                                    <img
                                        src="{{ asset('storage/'.$complaint->photo_before) }}"
                                        class="img-fluid rounded shadow-sm"
                                        style="max-height:350px">

                                </div>

                            @endif

                            @if($complaint->photo_after)

                                <div class="col-md-6 text-center">

                                    <p class="text-muted mb-2">
                                        Después
                                    </p>

                                    <img
                                        src="{{ asset('storage/'.$complaint->photo_after) }}"
                                        class="img-fluid rounded shadow-sm"
                                        style="max-height:350px">

                                </div>

                            @endif

                        </div>

                    </div>

                @endif


                @if($complaint->lat && $complaint->lng)

                    <div class="mb-3">
                        <strong>Ubicación</strong>

                        <div id="map"
                             style="height:400px"
                             data-lat="{{ $complaint->lat }}"
                             data-lng="{{ $complaint->lng }}">
                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>


    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const mapElement = document.getElementById("map");

            if (!mapElement) return;

            const lat = parseFloat(mapElement.dataset.lat);
            const lng = parseFloat(mapElement.dataset.lng);

            const map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map);

        });

    </script>

@endsection
