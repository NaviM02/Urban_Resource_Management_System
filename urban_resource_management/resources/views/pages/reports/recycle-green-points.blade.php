@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="mb-4">
            Puntos verdes más activos
        </h3>

        <table class="table table-bordered">

            <thead>
            <tr>
                <th>Punto verde</th>
                <th>Total reciclado (kg)</th>
                <th>Entregas</th>
            </tr>
            </thead>

            <tbody>

            @foreach($data as $row)

                <tr>
                    <td>{{ $row->green_point }}</td>
                    <td>{{ number_format($row->total_kg,2) }}</td>
                    <td>{{ $row->deliveries }}</td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

@endsection
