@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="mb-4">
            Tiempo promedio de atención de denuncias
        </h3>

        <div class="card shadow-sm">

            <div class="card-body">

                <h4>
                    {{ number_format($data->avg_hours,2) }} horas
                </h4>

                <p>
                    Promedio desde que inicia la limpieza
                    hasta que finaliza el trabajo.
                </p>

            </div>

        </div>

    </div>

@endsection
