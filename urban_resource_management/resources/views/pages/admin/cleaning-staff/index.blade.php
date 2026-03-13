@extends('layouts.app')

@section('content')

    <x-list-header
        title="Personal de Limpieza"
        description="Gestión del personal encargado de limpieza"
        createRoute="cleaning-staff.create"
        create-text="Agregar Personal"
    />

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th width="200">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @foreach($staff as $staffMember)
                    <tr>

                        <td>{{ $staffMember->name }}</td>
                        <td>{{ $staffMember->phone }}</td>

                        <td>
                            @if($staffMember->status_id == 1)
                                <span class="badge bg-success">
                                Activo
                            </span>
                            @else
                                <span class="badge bg-secondary">
                                Inactivo
                            </span>
                            @endif
                        </td>

                        <td>
                            <x-table.actions
                                :id="$staffMember->id"
                                viewRoute="cleaning-staff.show"
                                editRoute="cleaning-staff.edit"
                                deleteRoute="cleaning-staff.destroy"
                            />
                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
