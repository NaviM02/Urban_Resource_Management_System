@extends('layouts.app')

@section('content')

    <x-list-header
        title="Rutas"
        description="Gestión de rutas"
        createRoute="routes.create"
        create-text="Crear Ruta"
    />

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th width="200">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @foreach($routes as $route)
                    <tr>

                        <td>{{ $route->name }}</td>

                        <td>
                            @if($route->status_id == 1)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>

                        <td>
                            <x-table.actions
                                :id="$route->id"
                                viewRoute="routes.show"
                                editRoute="routes.edit"
                                deleteRoute="routes.destroy"
                            />
                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
