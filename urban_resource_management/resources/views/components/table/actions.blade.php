@props([
    'id',
    'viewRoute' => null,
    'editRoute' => null,
    'deleteRoute' => null
])

<div class="d-flex gap-2">

    @if($viewRoute)
        <a href="{{ route($viewRoute, $id) }}"
           class="btn btn-sm btn-outline-secondary">
            Ver
        </a>
    @endif

    @if ($editRoute)
        <a href="{{ route($editRoute, $id) }}"
           class="btn btn-sm btn-outline-primary">
            Editar
        </a>
    @endif

    @if($deleteRoute)
        <form method="POST"
              action="{{ route($deleteRoute, $id) }}"
              onsubmit="return confirm('¿Eliminar registro?')">

            @csrf
            @method('DELETE')

            <button class="btn btn-sm btn-outline-danger">
                Eliminar
            </button>
        </form>
    @endif

</div>
