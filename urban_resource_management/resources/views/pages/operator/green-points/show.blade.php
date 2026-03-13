@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">

        <x-detail-page-header
            itemName="{{ $greenPoint->name }}"
            description="Detalle del punto verde"
            backRoute="green-points.index"
            editRoute="green-points.edit"
            :editParams="[$greenPoint->id]"
        />

        <div class="card p-4">

            <div class="row">

                <x-show-field
                    label="Dirección"
                    :value="$greenPoint->address"
                />

                <x-show-field
                    label="Encargado"
                    :value="$greenPoint->manager->name ?? 'Sin encargado'"
                />

                <x-show-field
                    label="Capacidad total"
                    :value="$greenPoint->capacity_m3 . ' m³'"
                />

                <x-show-field
                    label="Horario"
                    :value="$greenPoint->open_time . ' - ' . $greenPoint->close_time"
                />

            </div>

            <hr class="my-4">

            <h5>Contenedores</h5>

            <div class="table-responsive">

                <table class="table table-bordered align-middle w-100">

                    <thead class="table-light">
                    <tr>
                        <th style="width:15%">Material</th>
                        <th style="width:10%">Capacidad</th>
                        <th style="width:25%">Llenado</th>
                        <th style="width:55%">Registrar</th>
                        <th style="width:5%">Vaciar</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($greenPoint->containers as $container)

                        <tr>

                            <td>{{ $container->materialType->name }}</td>

                            <td>{{ $container->capacity_kg }} kg</td>

                            <td>

                                @php
                                    $percent = min(100, ($container->current_kg / $container->capacity_kg) * 100);

                                    $barColor = 'bg-success';
                                    $alertText = '';

                                    if($percent >= 100){
                                    $barColor = 'bg-danger';
                                    }
                                    elseif($percent >= 90){
                                    $barColor = 'bg-danger';
                                    }
                                    elseif($percent >= 75){
                                    $barColor = 'bg-warning';
                                    }
                                @endphp

                                <div class="progress mb-1">

                                    <div
                                        class="progress-bar {{ $barColor }}"
                                        style="width: {{ $percent }}%"
                                    >

                                        {{ round($percent) }}%

                                    </div>

                                </div>

                                <small>{{ $container->current_kg }} kg</small>

                            </td>

                            <td>

                                <form
                                    method="POST"
                                    action="{{ route('green-points.delivery') }}"
                                    class="row g-2"
                                >

                                    @csrf

                                    <input type="hidden" name="green_point_id" value="{{ $greenPoint->id }}">
                                    <input type="hidden" name="container_id" value="{{ $container->id }}">

                                    <div class="col-md-2">

                                        @php
                                            $remaining = $container->capacity_kg - $container->current_kg;
                                        @endphp

                                        <input
                                            type="number"
                                            name="quantity_kg"
                                            class="form-control"
                                            placeholder="Kg"
                                            max="{{ $remaining }}"
                                            required
                                        >

                                    </div>

                                    <div class="col-md-4">

                                        <select
                                            class="form-select citizenType"
                                        >

                                            <option value="">Identificación</option>
                                            <option value="user">Usuario</option>
                                            <option value="dpi">DPI</option>

                                        </select>

                                    </div>

                                    <div class="col-md-4">

                                        <select
                                            name="user_id"
                                            class="form-select userSelect"
                                            style="display:none"
                                        >

                                            <option value="">Seleccionar usuario</option>

                                            @foreach($users as $user)

                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <input
                                            type="text"
                                            name="citizen_code"
                                            class="form-control dpiInput"
                                            placeholder="DPI"
                                            style="display:none"
                                        />

                                    </div>

                                    <div class="col-md-2">

                                        <button class="btn btn-success w-100">
                                            Registro
                                        </button>

                                    </div>

                                </form>

                            </td>

                            <td>
                                <form
                                    method="POST"
                                    action="{{ route('containers.empty') }}"
                                    class="d-inline"
                                >

                                    @csrf

                                    <input type="hidden" name="container_id" value="{{ $container->id }}">

                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger btn-md"
                                        title="Vaciar contenedor"
                                        onclick="return confirm('¿Vaciar contenedor?')"
                                    >

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>
                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection


@push('scripts')

    <script>

        document.querySelectorAll('.citizenType').forEach(select => {

            select.addEventListener('change', function(){

                let row = this.closest('form');

                let userSelect = row.querySelector('.userSelect');
                let dpiInput = row.querySelector('.dpiInput');

                userSelect.style.display = 'none';
                dpiInput.style.display = 'none';

                userSelect.value = '';
                dpiInput.value = '';

                if(this.value === 'user'){
                    userSelect.style.display = 'block';
                }

                if(this.value === 'dpi'){
                    dpiInput.style.display = 'block';
                }

            });

        });

    </script>

@endpush
