@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-form-page-header
            title="{{ isset($truck) ? 'Editar Camión' : 'Crear Camión' }}"
            :backRoute="'trucks.index'"
            :titleComplement="$truck->plate ?? null"
        />

        <form
            method="POST"
            action="{{ isset($truck) ? route('trucks.update',$truck->id) : route('trucks.store') }}"
            class="d-flex flex-column flex-grow-1"
        >

            @csrf

            @if(isset($truck))
                @method('PUT')
            @endif

            <div class="card p-4 flex-grow-1">

                <div class="row">

                    <div class="col-12 col-lg-6 mb-4">

                        <x-toggle-switch
                            name="status_id"
                            :checked="!isset($truck) || $truck->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                            checkedLabel="Activo"
                            uncheckedLabel="Inactivo"
                        />

                    </div>

                </div>

                <div class="row">

                    <div class="col-12 col-lg-6 mb-3">

                        <label>Placa</label>

                        <input
                            type="text"
                            name="plate"
                            class="form-control"
                            value="{{ old('plate',$truck->plate ?? '') }}"
                            required
                        >

                    </div>

                    <div class="col-12 col-lg-6 mb-3">

                        <label>Capacidad (Toneladas)</label>

                        <input
                            type="number"
                            name="capacity_tons"
                            class="form-control"
                            value="{{ old('capacity_tons',$truck->capacity_tons ?? '') }}"
                            required
                        >

                    </div>

                    <div class="col-12 col-lg-6 mb-3">

                        <label>Conductor</label>

                        <input
                            type="text"
                            name="driver_name"
                            class="form-control"
                            value="{{ old('driver_name',$truck->driver_name ?? '') }}"
                            required
                        >

                    </div>

                    <div class="col-12 col-lg-6 mb-3">

                        <label>Estado</label>

                        <select name="truck_status_id" class="form-select" required>

                            @foreach($statuses as $status)

                                <option value="{{ $status->id }}"
                                    @selected(old('truck_status_id',$truck->truck_status_id ?? '') == $status->id)>

                                    {{ $status->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

            <div class="mt-auto">

                <x-form-actions
                    cancelRoute="trucks.index"
                    :showDelete="isset($truck)"
                    :deleteRoute="'trucks.destroy'"
                    :deleteParams="[$truck->id ?? null]"
                    :saveText="isset($truck) ? 'Actualizar' : 'Crear'"
                />

            </div>

        </form>

    </div>

@endsection
