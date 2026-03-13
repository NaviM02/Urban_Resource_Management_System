@extends('layouts.app')

@section('content')

    <x-list-header
        title="Puntos Verdes"
        description="Gestión de puntos de reciclaje"
        createRoute="green-points.create"
        create-text="Crear Punto Verde"
    />

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Encargado</th>
                    <th width="200">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @foreach($greenPoints as $point)

                    <tr>

                        <td>{{ $point->name }}</td>

                        <td>{{ $point->address }}</td>

                        <td>{{ $point->manager->name ?? 'Sin encargado' }}</td>

                        <td>

                            <x-table.actions
                                :id="$point->id"
                                viewRoute="green-points.show"
                                editRoute="green-points.edit"
                                deleteRoute="green-points.destroy"
                            />

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
