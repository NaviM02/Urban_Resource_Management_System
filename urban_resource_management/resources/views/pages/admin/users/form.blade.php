@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column flex-grow-1">
        <x-form-page-header
            title="{{ isset($user) ? 'Editar Usuario' : 'Crear Usuario' }}"
            :backRoute="'users.index'"
            :titleComplement="$user->name ?? null"
        />

        <form
            method="POST"

            action="{{ isset($user)
            ? route('users.update',$user->id)
            : route('users.store') }}"
            class="d-flex flex-column flex-grow-1"
        >

            @csrf

            @if(isset($user))
                @method('PUT')
            @endif

            <div class="card p-4 flex-grow-1">

                <div class="row">
                    <div class="col-12 col-lg-6 mb-4">
                        <x-toggle-switch
                            name="status_id"
                            :checked="!isset($user) || $user->status_id == \App\Domain\Enums\StatusEnum::ACTIVE"
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
                            value="{{ old('name',$user->name ?? '') }}">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label>Rol</label>

                        <select name="role_id" class="form-select">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                        <label>Usuario</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="{{ old('username', $user->username ?? '') }}"
                               required>
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $user->email ?? '') }}">
                    </div>
                </div>

                @if(!isset($user))
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                required
                            >

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword()"
                            >
                                <i id="passwordIcon" class="bi bi-eye"></i>
                            </button>

                        </div>
                    </div>
                @endif


            </div>

            <div class="mt-auto">
                <x-form-actions
                    cancelRoute="users.index"
                    :showDelete="isset($user)"
                    :saveText="isset($user) ? 'Actualizar' : 'Crear'"
                />
            </div>

        </form>
        <script>
            function togglePassword() {
                const input = document.getElementById('password');
                const icon = document.getElementById('passwordIcon');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('bi-eye','bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('bi-eye-slash','bi-eye');
                }
            }
        </script>
    </div>
@endsection
