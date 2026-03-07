@extends('layouts.app')

@section('content')

    <x-list-header
        title="Usuarios"
        description="Gestión de usuarios del sistema"
        createRoute="users.create"
        create-text="Crear Usuario"
    />

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th width="200">Acciones</th>
                </tr>
                </thead>

                <tbody>

                @foreach($users as $user)
                    <tr>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role->name }}</td>

                        <td>
                            @if($user->status_id == 1)
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
                                :id="$user->id"
                                viewRoute="users.show"
                                editRoute="users.edit"
                                deleteRoute="users.destroy"
                            />
                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
