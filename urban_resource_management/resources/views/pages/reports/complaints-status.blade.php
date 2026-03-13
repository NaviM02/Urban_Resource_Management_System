@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="mb-4">
            Denuncias atendidas vs pendientes
        </h3>

        <table class="table table-bordered">

            <tr>
                <th>Atendidas</th>
                <th>Pendientes</th>
            </tr>

            <tr>
                <td>{{ $data->attended }}</td>
                <td>{{ $data->pending }}</td>
            </tr>

        </table>

    </div>

@endsection
