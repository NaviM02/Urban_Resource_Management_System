@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Municipal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            min-height: 0;
            overflow: hidden;
        }
    </style>
</head>

<body >

@include('components.header')

<div class="main-wrapper">

    @include('components.sidebar')

    <div class="flex-grow-1 px-4 pb-3 bg-light d-flex flex-column overflow-auto">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- map -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<!-- toaster -->
@if(session('toasts'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">

        @foreach(session('toasts') as $toast)

            <div class="toast align-items-center text-white border-0
             bg-{{ $toast['type'] === 'error' ? 'danger' : $toast['type'] }}"
                 role="alert">

                <div class="d-flex">

                    <div class="toast-body">
                        {{ $toast['message'] }}
                    </div>

                    <button type="button"
                            class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast">
                    </button>

                </div>

            </div>

        @endforeach

    </div>

    @php
        session()->forget('toasts');
    @endphp
@endif
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const toastElements = document.querySelectorAll('.toast');

        toastElements.forEach(el => {

            const toast = new bootstrap.Toast(el, {
                delay: 4000
            });

            toast.show();

        });

    });
</script>
@stack('scripts')
</body>
</html>
