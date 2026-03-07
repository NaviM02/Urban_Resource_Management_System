@extends('layouts.app')

@section('content')

    <x-list-header
        title="Zonas"
        description="Gestión de zonas"
        createRoute="zones.create"
        create-text="Crear Zona"
    />

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th width="200">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @foreach($zones as $zone)
                    <tr>

                        <td>{{ $zone->name }}</td>
                        <td>{{ $zone->description }}</td>

                        <td>
                            @if($zone->status_id == 1)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>

                        <td>
                            <x-table.actions
                                :id="$zone->id"
                                viewRoute="zones.show"
                                editRoute="zones.edit"
                                deleteRoute="zones.destroy"
                            />
                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
