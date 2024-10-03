    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Leave</h4>
            
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Leave Type</h5>
                            @can('create-leave')
                                <h5 class="mb-0"><a href="{{ route('leave.create') }}" class="float-end"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a></h5>
                            @endcan
                        </div>
                        <div class="table-responsive text-nowrap p-2">
                            @livewire('leave-list')
                        </div>
                    </div>
                </div>
                @can('view-holiday-leave')
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Holiday Leave</h5>
                                @canany(['create-holiday-leave', 'view-previous-leave'])
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            @can('create-holiday-leave')
                                                <a class="dropdown-item" href="{{ route('holidayleave.create') }}"><i class="ti ti-plus me-1"></i> Add</a>
                                            @endcan
                                            @can('view-previous-leave')
                                                <a class="dropdown-item" href="{{ route('holidayleave.previousleave') }}"><i class="ti ti-arrow-back-up me-1"></i> Previous Leaves</a>
                                            @endcan
                                        </div>
                                    </div>
                                @endcanany
                            </div>
                            <div class="table-responsive text-nowrap p-2">
                                @livewire('holiday-leave-list')
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    @endsection