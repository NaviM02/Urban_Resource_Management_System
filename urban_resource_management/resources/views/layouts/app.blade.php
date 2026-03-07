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
        }
    </style>
</head>

<body >

@include('components.header')

<div class="main-wrapper">

    @include('components.sidebar')

    <div class="flex-grow-1 px-4 pb-3 bg-light d-flex flex-column">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- map -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<!-- toaster -->
<x-toast />
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const toastEl = document.getElementById('appToast');

        if (!toastEl) return;

        window.showToast = function(message, type = 'info') {

            const body = toastEl.querySelector('.toast-body');
            body.textContent = message;

            toastEl.classList.remove(
                'text-bg-success',
                'text-bg-danger',
                'text-bg-warning',
                'text-bg-info'
            );

            const map = {
                success: 'text-bg-success',
                error: 'text-bg-danger',
                warning: 'text-bg-warning',
                info: 'text-bg-info'
            };

            toastEl.classList.add(map[type] ?? map.info);

            const toast = new bootstrap.Toast(toastEl, {
                delay: 4000
            });

            toast.show();
        };

        @if(session('error'))
        document.addEventListener('DOMContentLoaded', function () {
            showToast(
                @json(session('toast.message')),
                @json(session('toast.type'))
            );
        });
        @endif

    });
</script>
@stack('scripts')
</body>
</html>
