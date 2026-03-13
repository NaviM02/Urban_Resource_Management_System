@extends('layouts.app')

@section('content')

    <div class="container">

        <x-detail-page-header
            itemName="Denuncia: {{ $complaint->complaint_date }}"
            description="Detalle de la denuncia"
            backRoute="admin.complaints.index"
        />

        <div class="row">

            <div class="col-md-8">

                <div class="card shadow-sm mb-4">

                    <div class="card-header">
                        Información de la denuncia
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Fecha</strong><br>
                                {{ $complaint->complaint_date }}
                            </div>

                            <div class="col-md-6">
                                <strong>Estado actual</strong><br>

                                @if($complaint->complaint_status_id == 1)
                                    <span class="badge bg-secondary">Recibida</span>
                                @elseif($complaint->complaint_status_id == 2)
                                    <span class="badge bg-warning">En revisión</span>
                                @elseif($complaint->complaint_status_id == 3)
                                    <span class="badge bg-info">Asignada</span>
                                @elseif($complaint->complaint_status_id == 4)
                                    <span class="badge bg-primary">En atención</span>
                                @elseif($complaint->complaint_status_id == 5)
                                    <span class="badge bg-success">Atendida</span>
                                @elseif($complaint->complaint_status_id == 6)
                                    <span class="badge bg-dark">Cerrada</span>
                                @endif

                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>Dirección</strong>
                            <p>{{ $complaint->address ?? 'No especificada' }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Tamaño del basurero</strong>
                            <p>{{ ucfirst($complaint->dump_size) }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Descripción</strong>
                            <p>{{ $complaint->description }}</p>
                        </div>

                        @if($complaint->photo_before)
                            <div class="mb-3">
                                <strong>Fotografía</strong><br>

                                <img
                                    src="{{ asset('storage/'.$complaint->photo_before) }}"
                                    class="img-fluid rounded"
                                    style="max-width:400px">
                            </div>
                        @endif

                        @if($complaint->lat && $complaint->lng)

                            <div class="mb-3">

                                <strong>Ubicación</strong>

                                <div
                                    id="map"
                                    style="height:400px"
                                    data-lat="{{ $complaint->lat }}"
                                    data-lng="{{ $complaint->lng }}">
                                </div>

                            </div>

                        @endif

                    </div>
                </div>

            </div>


            <div class="col-md-4">

                @if($complaint->assignment)

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">
                            Cuadrilla asignada
                        </div>

                        <div class="card-body">

                            <p>
                                <strong>Fecha programada</strong><br>
                                {{ $complaint->assignment->scheduled_date }}
                            </p>

                            @if($complaint->assignment->started_at)

                                <p>
                                    <strong>Inicio de limpieza</strong><br>
                                    {{ \Carbon\Carbon::parse($complaint->assignment->started_at)->format('H:i') }}
                                </p>

                            @endif


                            @if($complaint->assignment->finished_at)

                                <p>
                                    <strong>Finalización</strong><br>
                                    {{ \Carbon\Carbon::parse($complaint->assignment->finished_at)->format('H:i') }}
                                </p>

                            @endif

                            <p>
                                <strong>
                                    Personal asignado ({{ $complaint->assignment->staff->count() }})
                                </strong>
                            </p>

                            <ul>
                                @foreach($complaint->assignment->staff as $member)
                                    <li>{{ $member->name }}</li>
                                @endforeach
                            </ul>

                            @if($complaint->assignment->estimated_resources)
                                <p>
                                    <strong>Recursos estimados</strong><br>
                                    {{ $complaint->assignment->estimated_resources }}
                                </p>
                            @endif

                        </div>

                    </div>

                @endif



                @if($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::REVIEW)

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">
                            Asignar cuadrilla de limpieza
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.complaints.assign',$complaint->id) }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">
                                        Seleccionar personal
                                    </label>

                                    <div
                                        class="border rounded p-2"
                                        style="max-height:200px; overflow-y:auto;">

                                        @foreach($staff as $member)

                                            <div class="form-check">

                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="staff_ids[]"
                                                    value="{{ $member->id }}"
                                                    id="staff{{ $member->id }}">

                                                <label
                                                    class="form-check-label"
                                                    for="staff{{ $member->id }}">

                                                    {{ $member->name }}

                                                </label>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Fecha programada
                                    </label>

                                    <input
                                        type="date"
                                        name="scheduled_date"
                                        class="form-control">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">
                                        Recursos estimados
                                    </label>

                                    <textarea
                                        name="estimated_resources"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Ej: camión recolector, 3 trabajadores, herramientas">
                                    </textarea>
                                </div>

                                <button class="btn btn-success w-100">
                                    Asignar cuadrilla
                                </button>

                            </form>

                        </div>

                    </div>

                @endif


                @if($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::ASSIGNED)

                    <div class="card shadow-sm mb-4">

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.complaints.startCleaning',$complaint->id) }}">
                                @csrf

                                <button class="btn btn-primary w-100">
                                    Cuadrilla llegó / Iniciar limpieza
                                </button>

                            </form>

                        </div>

                    </div>

                @endif


                @if($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::IN_PROGRESS)

                    <div class="card shadow-sm mb-4">

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.complaints.attended',$complaint->id) }}">
                                @csrf

                                <button class="btn btn-success w-100">
                                    Marcar limpieza completada
                                </button>

                            </form>

                        </div>

                    </div>

                @endif


                @if($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::ATTENDED)

                    <div class="card shadow-sm mb-4">

                        <div class="card-header">
                            Cerrar caso
                        </div>

                        <div class="card-body">

                            <form
                                method="POST"
                                action="{{ route('admin.complaints.close',$complaint->id) }}"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="mb-3">

                                    <label class="form-label">
                                        Fotografía final
                                    </label>

                                    <input
                                        type="file"
                                        name="photo_after"
                                        class="form-control">

                                </div>

                                <button class="btn btn-dark w-100">
                                    Cerrar denuncia
                                </button>

                            </form>

                        </div>

                    </div>

                @endif


                @if($complaint->complaint_status_id == \App\Domain\Enums\ComplaintStatusEnum::CLOSED)

                    <div class="card shadow-sm">

                        <div class="card-body text-center">

                            <h5 class="text-success">
                                Denuncia cerrada
                            </h5>

                            @if($complaint->photo_after)

                                <img
                                    src="{{ asset('storage/'.$complaint->photo_after) }}"
                                    class="img-fluid rounded mt-3">

                            @endif

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>


    <script>

        document.addEventListener("DOMContentLoaded", function(){

            const mapElement = document.getElementById("map");

            if(!mapElement) return;

            const lat = parseFloat(mapElement.dataset.lat);
            const lng = parseFloat(mapElement.dataset.lng);

            const map = L.map('map').setView([lat,lng], 15);

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    attribution:'© OpenStreetMap'
                }
            ).addTo(map);

            L.marker([lat,lng]).addTo(map);

        });

    </script>

@endsection
