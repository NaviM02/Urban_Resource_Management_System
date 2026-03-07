<div class="py-4 border-bottom mb-4">

    <div class="d-flex justify-content-between align-items-start">

        <div>

            <div class="d-flex align-items-center gap-2">

                @if($backRoute)
                    <a href="{{ route($backRoute) }}"
                       class="text-decoration-none fs-5">
                        ←
                    </a>
                @endif

                <h4 class="fw-normal m-0">
                    {{ $itemName }}
                </h4>

            </div>

            @if($description)
                <p class="text-muted m-0 mt-1">
                    {{ $description }}
                </p>
            @endif

        </div>

        <div class="d-flex gap-2">

            @if($editRoute)
                <a href="{{ route($editRoute, $editParams ?? []) }}"
                   class="btn btn-primary">
                    Editar
                </a>
            @endif

        </div>

    </div>

</div>
