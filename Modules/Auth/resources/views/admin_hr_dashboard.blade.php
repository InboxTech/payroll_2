    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <h4 class="py-2">Dashboard</h4>

            @foreach($todaysBirthDay as $bkey => $bvalue)
                @if($bvalue->id != Auth::user()->id)
                    <div class="alert alert-success alert-dismissible d-flex align-items-baseline" role="alert">
                        <span class="alert-icon alert-icon-lg text-success me-2">
                            <i class="ti ti-cake ti-sm"></i>
                        </span>
                        <div class="d-flex flex-column ps-1">
                            <h5 class="alert-heading mb-2">Today's Birth Day</h5>
                            <p class="mb-0">
                                Today is {{ $bvalue->full_name }} birth day wish them.
                            </p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                    <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                        <span class="alert-icon text-success me-2">
                            <i class="ti ti-cake ti-xs"></i>
                        </span>
                        Happy Birth Day {{ $bvalue->full_name }}. Wish You Many Many Happy Returns of the Day.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach

            @foreach($todaysProbationEnd as $pkey => $pvalue)
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <span class="alert-icon text-info me-2">
                        <i class="ti ti-calendar ti-xs"></i>
                    </span>
                    Todays {{ $pvalue->full_name }} probation end day
                </div>
            @endforeach

            <!-- Card Border Shadow -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="card card-border-shadow-primary">
                        <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">42</h4>
                        </div>
                        <p class="mb-1">On route vehicles</p>
                        <p class="mb-0">
                            <span class="fw-medium me-1">+18.2%</span>
                            <small class="text-muted">than last week</small>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="card card-border-shadow-warning">
                        <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"
                                ><i class="ti ti-alert-triangle ti-md"></i
                            ></span>
                            </div>
                            <h4 class="ms-1 mb-0">8</h4>
                        </div>
                        <p class="mb-1">Vehicles with errors</p>
                        <p class="mb-0">
                            <span class="fw-medium me-1">-8.7%</span>
                            <small class="text-muted">than last week</small>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-danger">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-danger"
                            ><i class="ti ti-git-fork ti-md"></i
                        ></span>
                        </div>
                        <h4 class="ms-1 mb-0">27</h4>
                    </div>
                    <p class="mb-1">Deviated from route</p>
                    <p class="mb-0">
                        <span class="fw-medium me-1">+4.3%</span>
                        <small class="text-muted">than last week</small>
                    </p>
                    </div>
                </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-info">
                    <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-info"><i class="ti ti-clock ti-md"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">13</h4>
                    </div>
                    <p class="mb-1">Late vehicles</p>
                    <p class="mb-0">
                        <span class="fw-medium me-1">-2.5%</span>
                        <small class="text-muted">than last week</small>
                    </p>
                    </div>
                </div>
                </div>
            </div>
            <!--/ Card Border Shadow -->
            <div class="row">
                <div class="col-lg-6 mb-4 order-2 order-xxl-2">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title m-0 me-2">Today's Leave</h5>
                            <div class="dropdown">
                                Date : {{ \Carbon\Carbon::now()->format('d-m-Y') }}
                            </div>
                            <div class="dropdown d-none">
                                <button class="btn p-0" type="button" id="teamMemberList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="teamMemberList">
                                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless border-top">
                                <thead class="border-bottom">
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Leave Type</th>
                                        <th>Leave Mode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($leaveList as $key => $value)
                                        <tr>
                                            <td>
                                                {{ $value->user->full_name }}
                                            </td>
                                            <td>
                                                {{ $value->leave->leave_type_name }}
                                            </td>
                                            <td>
                                                @switch($value->leave_mode)
                                                    @case(1)
                                                        Full Day
                                                        @break
                                                    @case(2)
                                                        Half Day - 1st
                                                        @break
                                                    @case(2)
                                                        Half Day - 2nd
                                                        @break
                                                    @default
                                                        @break
                                                @endswitch
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Today's no one on leave</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 order-5">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">On route vehicles</h5>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="routeVehicles" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="routeVehicles">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-datatable table-responsive">
                            <table class="dt-route-vehicles table">
                                <thead class="border-top">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>location</th>
                                        <th>starting route</th>
                                        <th>ending route</th>
                                        <th>warnings</th>
                                        <th class="w-20">progress</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <!--/ On route vehicles Table -->
            </div>
        </div>
    @endsection
    @push('script')
        <script src="{{ asset('admin/assets/js/app-logistics-dashboard.js') }}"></script>
    @endpush