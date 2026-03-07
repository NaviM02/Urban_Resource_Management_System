@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-detail-page-header
            itemName="{{ $user->name }}"
            description="Detalle del usuario"
            backRoute="users.index"
            editRoute="users.edit"
            :editParams="[$user->id]"
        />

        <div class="card p-4">

            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <x-toggle-switch
                        name="status_id"
                        :checked="!isset($user) || $user->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                        disabled="true"
                        checkedLabel="Activo"
                        uncheckedLabel="Inactivo"
                    />
                </div>
            </div>

            <div class="row">

                <x-show-field
                    label="Nombre"
                    :value="$user->name"
                />

                <x-show-field
                    label="Usuario"
                    :value="$user->username"
                />

            </div>

            <div class="row">

                <x-show-field
                    label="Email"
                    :value="$user->email"
                />

                <x-show-field
                    label="Rol"
                    :value="$user->role->name"
                />

            </div>

        </div>

    </div>

@endsection
