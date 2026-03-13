@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-form-page-header
            title="{{ isset($staff) ? 'Editar Personal' : 'Crear Personal de Limpieza' }}"
            :backRoute="'cleaning-staff.index'"
            :titleComplement="$staff->name ?? null"
        />

        <form
            method="POST"
            action="{{ isset($staff)
        ? route('cleaning-staff.update',$staff->id)
        : route('cleaning-staff.store') }}"
            class="d-flex flex-column flex-grow-1"
        >

            @csrf

            @if(isset($staff))
                @method('PUT')
            @endif

            <div class="card p-4 flex-grow-1">

                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">

                        <x-toggle-switch
                            name="status_id"
                            :checked="!isset($staff) || $staff->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
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
                            value="{{ old('name',$staff->name ?? '') }}"
                            required
                        >
                    </div>

                    <div class="col-12 col-lg-6 mb-3">
                        <label>Teléfono</label>
                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone',$staff->phone ?? '') }}"
                        >
                    </div>

                </div>

            </div>

            <div class="mt-auto">

                <x-form-actions
                    cancelRoute="cleaning-staff.index"
                    :showDelete="isset($staff)"
                    :saveText="isset($staff) ? 'Actualizar' : 'Crear'"
                />

            </div>

        </form>

    </div>

@endsection
