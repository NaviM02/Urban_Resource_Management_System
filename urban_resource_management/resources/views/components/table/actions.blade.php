<div class="d-flex gap-2">

    <a href="{{ route($viewRoute, $id) }}"
       class="btn btn-sm btn-outline-secondary">
        Ver
    </a>

    <a href="{{ route($editRoute, $id) }}"
       class="btn btn-sm btn-outline-primary">
        Editar
    </a>

    <form method="POST"
          action="{{ route($deleteRoute, $id) }}"
          onsubmit="return confirm('¿Eliminar registro?')">

        @csrf
        @method('DELETE')

        <button class="btn btn-sm btn-outline-danger">
            Eliminar
        </button>
    </form>

</div>
