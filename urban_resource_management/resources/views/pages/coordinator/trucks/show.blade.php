@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-detail-page-header
            itemName="{{ $truck->plate }}"
            description="Detalle del camión"
            backRoute="trucks.index"
            editRoute="trucks.edit"
            :editParams="[$truck->id]"
        />

        <div class="card p-4">

            <div class="row">
                <div class="col-12 col-lg-6 mb-4">
                    <x-toggle-switch
                        name="status_id"
                        :checked="$truck->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                        disabled="true"
                        checkedLabel="Activo"
                        uncheckedLabel="Inactivo"
                    />
                </div>
            </div>

            <div class="row">

                <x-show-field
                    label="Placa"
                    :value="$truck->plate"
                />

                <x-show-field
                    label="Capacidad (Toneladas)"
                    :value="$truck->capacity_tons"
                />

                <x-show-field
                    label="Conductor"
                    :value="$truck->driver_name"
                />

                <x-show-field
                    label="Estado"
                    :value="$truck->truckStatus->name ?? ''"
                />

            </div>

        </div>

    </div>

@endsection
