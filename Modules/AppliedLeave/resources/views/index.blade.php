    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span>Applied Leave</h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        <a href="javascript:void(0);" class="btn btn-outline-danger delete_records"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
                        <!-- <a href="{{ route('leaveapply.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a> -->
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center" id="AppliedLeave">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" class="form-check-input jsCheckAll"></th>
                                <th class="text-center">Employee Name</th>
                                <th class="text-center">Leave Type Name</th>
                                <th class="text-center">From Date - To Date</th>
                                <th class="text-center">Total Leave Day</th>
                                <th class="text-center">Approval Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        @endsection

        @push('script')
        <script type="text/javascript">
            var table_id = $("#AppliedLeave");
            var delete_url = "{{ route('appliedleave.delete') }}";

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [],
                    ajax: {
                        url:"{{ route('appliedleave.index') }}",
                    },
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        { data: 'employee_name', name: 'employee_name' },
                        { data: 'leave_type_name', name: 'leave_type_name' },
                        { data: 'from_date_to_date', name: 'from_date_to_date'},
                        { data: 'number_of_days', name: 'number_of_days' },
                        { data: 'approval_status', name: 'approval_status'},
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                });
        
                $(".form-control").keyup(function(){
                    table.draw();
                });
            });
        </script>
    @endpush
