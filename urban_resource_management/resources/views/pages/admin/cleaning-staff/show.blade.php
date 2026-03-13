@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-detail-page-header
            itemName="{{ $staff->name }}"
            description="Detalle del personal de limpieza"
            backRoute="cleaning-staff.index"
            editRoute="cleaning-staff.edit"
            :editParams="[$staff->id]"
        />

        <div class="card p-4">

            <div class="row">

                <div class="col-12 col-lg-6 mb-4">

                    <x-toggle-switch
                        name="status_id"
                        :checked="$staff->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                        disabled="true"
                        checkedLabel="Activo"
                        uncheckedLabel="Inactivo"
                    />

                </div>

            </div>

            <div class="row">

                <x-show-field
                    label="Nombre"
                    :value="$staff->name"
                />

                <x-show-field
                    label="Teléfono"
                    :value="$staff->phone"
                />

            </div>

            <div class="row">

                <x-show-field
                    label="Disponible"
                    :value="$staff->available ? 'Si': 'No'"
                />

            </div>

        </div>

    </div>

@endsection
