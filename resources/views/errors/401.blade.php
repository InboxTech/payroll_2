    @extends('layout.error_layout')
    @section('content')
        <div class="misc-wrapper">
            <h2 class="mb-1 mt-4">401 Page Not Found :(</h2>
            <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
            <a href="{{ route('back') }}" class="btn btn-primary mb-4">Back to home</a>
            <div class="mt-4">
                <img src="{{ asset('admin/assets/img/illustrations/page-misc-error.png') }}" alt="page-misc-error" width="225" class="img-fluid" />
            </div>
        </div>
    @endsection