@if(session('toast'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">

        <div id="appToast"
             class="toast align-items-center text-white border-0 show
         bg-{{ session('toast.type') === 'error' ? 'danger' : session('toast.type') }}"
             role="alert">

            <div class="d-flex">
                <div class="toast-body">
                    {{ session('toast.message') }}
                </div>

                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast">
                </button>
            </div>

        </div>

    </div>
@endif
