@php($user = auth()->user())
<nav class="navbar navbar-dark bg-dark px-4 py-3">

    <span class="navbar-brand mb-0 h5">
        Sistema Municipal
    </span>

    <div class="ms-auto dropdown">

        <a href="#"
           class="text-white text-decoration-none d-flex align-items-center gap-2"
           role="button"
           data-bs-toggle="dropdown">

            <div class="d-flex flex-column text-end">
                <span>{{ auth()->user()->name }}</span>

                <small class="text-secondary">
                    {{ auth()->user()->role->name }}
                </small>
            </div>

            <i class="bi bi-caret-down-fill"></i>

        </a>

        <ul class="dropdown-menu dropdown-menu-end">

            <li>
                <a class="dropdown-item" href="#">
                    Perfil
                </a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item">
                        Cerrar sesión
                    </button>
                </form>
            </li>

        </ul>

    </div>

</nav>
