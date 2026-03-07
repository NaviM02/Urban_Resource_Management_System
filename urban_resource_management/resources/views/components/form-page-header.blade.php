<div class="py-4 border-bottom mb-4">

    <div class="d-flex align-items-center gap-2">

        @if($backRoute)
            <a href="{{ route($backRoute) }}"
               class="text-decoration-none fs-5">
                ←
            </a>
        @endif

        @if($titleComplement)
            <h4 class="fw-bold m-0">
                {{ $title }}:
            </h4>

            <h4 class="fw-normal m-0">
                {{ $titleComplement }}
            </h4>
        @else
            <h4 class="fw-bold m-0">
                {{ $title }}
            </h4>
        @endif

    </div>

    @if($description)
        <p class="text-muted m-0 mt-1">
            {{ $description }}
        </p>
    @endif

</div>
