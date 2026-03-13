@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="mb-4">
            Material reciclado por tipo
        </h3>

        <table class="table table-bordered">

            <thead>
            <tr>
                <th>Material</th>
                <th>Total reciclado (kg)</th>
            </tr>
            </thead>

            <tbody>

            @foreach($data as $row)

                <tr>
                    <td>{{ $row->material }}</td>
                    <td>{{ number_format($row->total_kg,2) }}</td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

@endsection
