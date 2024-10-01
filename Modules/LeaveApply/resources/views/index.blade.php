    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Leave Apply</h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        @can('delete-leave-apply')
                            <a href="javascript:void(0);" class="btn btn-outline-danger delete_records"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
                        @endcan
                        @can('create-leave-apply')
                            <a href="{{ route('leaveapply.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @forelse ($assignLeaveList as $key => $value)
                    <div class="col-sm-6 col-lg-3 mb-4">
                        <div class="card card-border-shadow-primary">
                            <div class="card-body text-center">
                                <p class="mb-1"><strong>{{ $value->leave->leave_type_name }}</strong></p>
                                <p class="mb-0">
                                    <span class="fw-medium me-1">Leave Balance : {{ $value->leave_balance }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card card-border-shadow-primary align-items-center">
                            <div class="card-body">
                                <p class="mb-1">No Leaves Assign</p>
                            </div>
                        </div>
                    </div>
                @endforelse()
            </div>
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center table-responsive text-nowrap" id="LeaveApply">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" class="form-check-input jsCheckAll"></th>
                                <th class="text-center">Leave Type Name</th>
                                <th class="text-center">From Date - To Date</th>
                                <th class="text-center">Total Leave Day</th>
                                <th class="text-center">Approval Status</th>
                                <th class="text-center">Apply Date</th>
                                <th class="text-center">Is Leave Cancle</th>
                                @can('edit-leave-apply')
                                    <th class="text-center">Action</th>
                                @endcan
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endsection

        @push('script')
        <script type="text/javascript">
            var table_id = $("#LeaveApply");
            var delete_url = "{{ route('leaveapply.delete') }}";
            var status_url = "{{ route('leaveapply.change_status') }}";

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [],
                    ajax: {
                        url:"{{ route('leaveapply.index') }}",
                    },
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        { data: 'leave_type_name', name: 'leave_type_name' },
                        { data: 'from_date_to_date', name: 'from_date_to_date'},
                        { data: 'number_of_days', name: 'number_of_days' },
                        { data: 'approval_status', name: 'approval_status'},
                        { data: 'apply_date', name: 'apply_date'},
                        { data: 'is_leave_cancle', name: 'is_leave_cancle'},
                        @can('edit-leave-apply')
                            { data: 'action', name: 'action', orderable: false, searchable: false },
                        @endcan
                    ],
                });
        
                $(".form-control").keyup(function(){
                    table.draw();
                });
            });
        </script>
    @endpush
