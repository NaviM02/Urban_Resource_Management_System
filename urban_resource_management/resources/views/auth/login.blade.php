@extends('layouts.guest')

@section('title', 'Inicio de Sesión')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Inicio de sesión</h4>
                    <small>Sistema Municipal Recolección de Basura</small>
                </div>

                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.process') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Usuario</label>
                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Contraseña</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Iniciar Sesión
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
