<div class="bg-light border overflow-auto" style="width:250px;">

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

                <a href="{{ route('cleaning-staff.index') }}" class="nav-link text-black p-3">
                    Personal de Limpieza
                </a>
                <a href="{{ route('admin.complaints.index')  }}" class="nav-link text-black p-3">
                    Denuncias
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
                <a href="{{ route('trucks.index') }}" class="nav-link text-black p-3">
                    Camiones
                </a>
                <a href="{{ route('collections.index') }}" class="nav-link text-black p-3">
                    Recolección
                </a>
            </li>
        @endif


        {{-- OPERATOR --}}
        @if(
            auth()->user()->role_id === \App\Domain\Enums\RoleEnum::OPERATOR
            || auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ADMIN
        )
            <li>
                <a href="{{ route('green-points.index') }}" class="nav-link text-black p-3">
                    Puntos Verdes
                </a>
                <a href="{{ route('green-points-map.index') }}" class="nav-link text-black p-3">
                    Mapa Puntos Verdes
                </a>
            </li>
        @endif

        {{-- CIVIL --}}
        @if(auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ADMIN)
            <li>
                <a href="#" class="nav-link text-black p-3">
                    Rutas
                </a>
                <a href="{{ route('citizen.complaints.index')  }}" class="nav-link text-black p-3">
                    Denuncias
                </a>
            </li>
        @endif

        {{-- AUDITOR --}}
        @if(
            auth()->user()->role_id === \App\Domain\Enums\RoleEnum::AUDITOR
            || auth()->user()->role_id === \App\Domain\Enums\RoleEnum::ADMIN
        )
            <li class="nav-item">
                <a class="nav-link text-black p-3" href="#reportsMenu">
                    Reportes Recoleccion
                </a>

                <div  id="reportsMenu">

                    <ul class="nav flex-column ms-3">

                        <li class="nav-item ">
                            <a class="nav-link text-black"
                               href="{{ route('reports.period') }}">
                                Por período
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-black"
                               href="{{ route('reports.zone') }}">
                                Por zona
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link text-black"
                               href="{{ route('reports.route') }}">
                                Por ruta
                            </a>
                        </li>

                    </ul>

                </div>

                <a class="nav-link text-black p-3" href="#reportsMenu">
                    Reportes Punto Verde
                </a>

                <div  id="reportsMenu">

                    <ul class="nav flex-column ms-3">

                        <li class="nav-item ">
                            <a class="nav-link text-black"
                               href="{{ route('reports.recycling.materials') }}">
                                Material reciclado
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-black"
                               href="{{ route('reports.recycling.green-points') }}">
                                Puntos verdes activos
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link text-black"
                               href="{{ route('reports.recycling.trend') }}">
                                Tendencia de reciclaje
                            </a>
                        </li>

                    </ul>

                </div>
            </li>
        @endif

        <li class="nav-item m-3">

        </li>

    </ul>

</div>
