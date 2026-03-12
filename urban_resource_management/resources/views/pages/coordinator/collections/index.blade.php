@extends('layouts.app')

@section('content')

    <x-list-header
        title="Recolecciones"
        description="Gestión de recolecciones"
        createRoute="collections.create"
        create-text="Programar recolección"
    />

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Ruta</th>
                    <th>Camión</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th width="200">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @foreach($collections as $collection)

                    <tr>

                        <td>{{ $collection->route->name }}</td>

                        <td>{{ $collection->truck->plate }}</td>

                        <td>{{ $collection->scheduled_date }}</td>

                        <td>
                            <span class="badge {{ $collection->getStatusBadgeClass() }}">
                                {{ $collection->collectionStatus->name }}
                            </span>
                        </td>

                        <td>

                            <x-table.actions
                                :id="$collection->id"
                                viewRoute="collections.show"
                            />

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
