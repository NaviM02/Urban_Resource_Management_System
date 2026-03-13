@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="mb-4">
            Zonas con mayor cantidad de denuncias
        </h3>

        <table class="table table-bordered">

            <thead>
            <tr>
                <th>Zona</th>
                <th>Total denuncias</th>
            </tr>
            </thead>

            <tbody>

            @foreach($data as $row)

                <tr>
                    <td>{{ $row->zone }}</td>
                    <td>{{ $row->total }}</td>
                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

@endsection
