<div class="d-flex justify-content-between align-items-center py-4">

    <div>
        <h4 class="fw-bold mb-1">
            {{ $title }}
        </h4>

        @isset($description)
            <small class="text-muted">
                {{ $description }}
            </small>
        @endisset
    </div>

    @isset($createRoute)
        <a href="{{ route($createRoute) }}"
           class="btn btn-primary">

            + {{ $createText ?? 'Crear' }}
        </a>
    @endisset

</div>
