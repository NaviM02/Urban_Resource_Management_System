@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="mb-4">
            Reporte de toneladas recolectadas por período
        </h3>

        <form method="GET" class="row mb-4">

            <div class="col-md-3">
                <label>Tipo de período</label>
                <select name="type" class="form-select">

                    <option value="day" {{ $type=='day' ? 'selected' : '' }}>
                        Por día
                    </option>

                    <option value="week" {{ $type=='week' ? 'selected' : '' }}>
                        Por semana
                    </option>

                    <option value="month" {{ $type=='month' ? 'selected' : '' }}>
                        Por mes
                    </option>

                </select>
            </div>


            <div class="col-md-3">
                <label>Fecha inicio</label>
                <input
                    type="date"
                    name="start_date"
                    class="form-control"
                    value="{{ request('start_date') }}"
                >
            </div>


            <div class="col-md-3">
                <label>Fecha fin</label>
                <input
                    type="date"
                    name="end_date"
                    class="form-control"
                    value="{{ request('end_date') }}"
                >
            </div>


            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    Generar reporte
                </button>
            </div>

        </form>


        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th>Periodo</th>
                <th>Toneladas recolectadas</th>
            </tr>
            </thead>

            <tbody>

            @forelse($data as $row)

                <tr>
                    <td>{{ $row->period }}</td>
                    <td>{{ number_format($row->tons,2) }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="2" class="text-center">
                        No hay datos
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

@endsection
