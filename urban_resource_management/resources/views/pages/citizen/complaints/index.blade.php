@extends('layouts.app')

@section('content')

    <x-list-header
        title="Mis Denuncias"
        description="Denuncias que has registrado"
        createRoute="citizen.complaints.create"
        create-text="Nueva Denuncia"
    />

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Dirección</th>
                    <th>Tamaño Basurero</th>
                    <th>Estado</th>
                    <th width="200">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @foreach($complaints as $complaint)

                    <tr>

                        <td>{{ $complaint->complaint_date }}</td>

                        <td>{{ $complaint->address }}</td>

                        <td>{{ $complaint->dump_size }}</td>

                        <td>
                            <span class="badge bg-info">
                            {{ $complaint->status->name }}
                            </span>
                        </td>

                        <td>

                            <a
                                href="{{ route('citizen.complaints.show',$complaint->id) }}"
                                class="btn btn-sm btn-outline-primary"
                            >
                                Ver
                            </a>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
