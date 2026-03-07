<div class="d-flex justify-content-between align-items-center mt-4">

    <div class="d-flex gap-2">

        @if($cancelRoute)
            <a href="{{ route($cancelRoute) }}"
               class="btn btn-secondary px-4">
                Cancelar
            </a>
        @endif

        @if($showDelete)
            <button
                type="submit"
                formaction="{{ url()->current() }}"
                formmethod="POST"
                name="_method"
                value="DELETE"
                class="btn btn-outline-danger px-4">
                Eliminar
            </button>
        @endif

    </div>

    @if($showSave)
        <button type="submit" class="btn btn-primary px-5">
            {{ $saveText }}
        </button>
    @endif

</div>
