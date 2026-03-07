<div class="bg-light border" style="width:250px;">

    <style>
        .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.21);
        }
    </style>

    <ul class="nav flex-column">

        <li>
            <a href="{{ route('dashboard') }}" class="nav-link p-3 text-black">
                Dashboard
            </a>
        </li>

        {{-- ADMIN --}}
        @if(auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ADMIN)
            <li>
                <a href="{{ route('users.index') }}" class="nav-link text-black p-3">
                    Usuarios
                </a>

                <a class="nav-link text-black p-3" href="#">
                    Configuración del sistema
                </a>
                <a class="nav-link text-black p-3" href="#">
                    Generación de reportes
                </a>
                <a class="nav-link text-black p-3" href="#">
                    Auditoría de actividades
                </a>
        @endif


        {{-- ROUTE COORDINATOR --}}
        @if(
            auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ROUTE_COORDINATOR
            || auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ADMIN
        )
            <li>
                <a href="{{ route('zones.index') }}" class="nav-link text-black p-3">
                    Zonas
                </a>
                <a href="{{ route('routes.index') }}" class="nav-link text-black p-3">
                    Rutas
                </a>
            </li>
        @endif


        {{-- OPERATOR --}}
        @if(
            auth()->user()->role_id === \App\Domain\Enums\RoleEnum::OPERATOR
            || auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ADMIN
        )
            <li>
                <a href="{{ route('users.index') }}" class="nav-link text-black p-3">
                    Puntos Verdes
                </a>
            </li>
        @endif

        {{-- CIVIL --}}
        @if(auth()->user()->role_id === \App\Domain\Enums\RoleEnum::CIVIL)
            <li>
                <a href="#" class="nav-link text-black p-3">
                    Mis Reportes
                </a>
            </li>
        @endif

        {{-- AUDITOR --}}
        @if(
            auth()->user()->role_id === \App\Domain\Enums\RoleEnum::AUDITOR
            || auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ADMIN
        )
            <li>
                <a href="#" class="nav-link text-black p-3">
                    Reportes
                </a>
            </li>
        @endif

    </ul>

</div>
