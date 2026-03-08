@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-form-page-header
            title="{{ isset($zone) ? 'Editar Zona' : 'Crear Zona' }}"
            :backRoute="'zones.index'"
            :titleComplement="$zone->name ?? null"
        />

        <form
            method="POST"
            action="{{ isset($zone) ? route('zones.update',$zone->id) : route('zones.store') }}"
            class="d-flex flex-column flex-grow-1"
        >

            @csrf

            @if(isset($zone))
                @method('PUT')
            @endif

            <div class="card p-4 flex-grow-1">

                <div class="row">

                    <div class="col-12 col-lg-6 mb-4">

                        <x-toggle-switch
                            name="status_id"
                            :checked="!isset($zone) || $zone->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
                            checkedLabel="Activo"
                            uncheckedLabel="Inactivo"
                        />

                    </div>

                </div>

                <div class="row">

                    <div class="col-12 col-lg-6 mb-3">

                        <label>Nombre</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name',$zone->name ?? '') }}"
                        >

                    </div>

                    <div class="col-12 col-lg-6 mb-3">
                        <label>Tipo de zona</label>

                        <select name="zone_type_id" class="form-select" required>

                            @foreach($zoneTypes as $type)

                                <option value="{{ $type->id }}"
                                    @selected(old('zone_type_id', $zone->zone_type_id ?? '') == $type->id)>

                                    {{ $type->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-12 col-lg-6 mb-3">

                        <label>Descripción</label>

                        <input
                            type="text"
                            name="description"
                            class="form-control"
                            value="{{ old('description',$zone->description ?? '') }}"
                        >

                    </div>

                </div>

            </div>

            <div class="mt-auto">

                <x-form-actions
                    cancelRoute="zones.index"
                    :showDelete="isset($zone)"
                    :saveText="isset($zone) ? 'Actualizar' : 'Crear'"
                />

            </div>

        </form>

    </div>

@endsection
