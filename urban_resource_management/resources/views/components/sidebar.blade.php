<div class="bg-light border text-black vh-100" style="width:250px; min-height:calc(100vh - 72px);">

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
                <a class="nav-link text-black p-3" href="#">
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
            /*|| auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ADMIN*/
        )
            <li>
                <a class="nav-link text-black" href="#">
                    Rutas
                </a>
            </li>
        @endif


        {{-- OPERATOR --}}
        @if(auth()->user()->role_id === \App\Domain\Enums\RoleEnum::OPERATOR)
            <li>
                <a class="nav-link text-black" href="#">
                    Puntos Verdes
                </a>
            </li>
        @endif

        {{-- CIVIL --}}
        @if(auth()->user()->role_id === \App\Domain\Enums\RoleEnum::CIVIL)
            <li>
                <a class="nav-link text-black" href="#">
                    Mis Reportes
                </a>
            </li>
        @endif

        {{-- AUDITOR --}}
        @if(auth()->user()->role_id === \App\Domain\Enums\RoleEnum::AUDITOR)
            <li>
                <a class="nav-link text-black" href="#">
                    Reportes
                </a>
            </li>
        @endif

    </ul>

</div>
