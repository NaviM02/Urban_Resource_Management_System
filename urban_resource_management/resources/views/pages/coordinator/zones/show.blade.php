@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-detail-page-header
            itemName="{{ $zone->name }}"
            description="Detalle de la zona"
            backRoute="zones.index"
            editRoute="zones.edit"
            :editParams="[$zone->id]"
        />

        <div class="card p-4">

            <div class="row">

                <div class="col-12 col-lg-6 mb-4">

                    <x-toggle-switch
                        name="status_id"
                        :checked="$zone->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                        disabled="true"
                        checkedLabel="Activo"
                        uncheckedLabel="Inactivo"
                    />

                </div>

            </div>

            <div class="row">

                <x-show-field
                    label="Nombre"
                    :value="$zone->name"
                />

                <x-show-field
                    label="Descripción"
                    :value="$zone->description"
                />

            </div>

        </div>

    </div>

@endsection
