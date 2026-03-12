@extends('layouts.app')

@section('content')

    <x-list-header
        title="Camiones"
        description="Gestión de camiones"
        createRoute="trucks.create"
        create-text="Crear Camión"
    />

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Placa</th>
                    <th>Capacidad (Ton)</th>
                    <th>Conductor</th>
                    <th>Estado</th>
                    <th width="200">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @foreach($trucks as $truck)

                    <tr>

                        <td>{{ $truck->plate }}</td>

                        <td>{{ $truck->capacity_tons }}</td>

                        <td>{{ $truck->driver_name }}</td>

                        <td>
                            <span class="badge {{ $truck->getStatusBadgeClass() }}">
                                {{ $truck->truckStatus->name }}
                            </span>
                        </td>

                        <td>
                            <x-table.actions
                                :id="$truck->id"
                                viewRoute="trucks.show"
                                editRoute="trucks.edit"
                                deleteRoute="trucks.destroy"
                            />
                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
