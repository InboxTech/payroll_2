    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Hr</h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        @can('delete-leave-hr')
                            <a href="javascript:void(0);" class="btn btn-outline-danger delete_records"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="accordion" id="collapsibleSection">
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingDeliveryAddress">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseDeliveryAddress" aria-expanded="true" aria-controls="collapseDeliveryAddress">
                                    Searching...
                                </button>
                            </h2>
                            <div id="collapseDeliveryAddress" class="accordion-collapse collapse" data-bs-parent="#collapsibleSection">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label" for="collapsible-phone">Employee List</label>
                                            <select name="user_id" class="form-select jsEmployeeId">
                                                <option value="">Select Employee</option>
                                                @foreach($userList as $ukey => $uvalue)
                                                    <option value="{{ $ukey }}">{{ $uvalue }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="from-date">From Date</label>
                                            <input type="date" name="from_date" class="form-control jsFromDate"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="to-date">To Date</label>
                                            <input type="date" name="to_date" class="form-control jsToDate"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="collapsible-phone">Approval Status</label>
                                            <select name="is_approved" class="form-select jsApprovalStatus">
                                                <option value="">Select Status</option>
                                                @foreach(config('constant.leave_status') as $lskey => $lsvalue)
                                                    <option value="{{ $lskey }}">{{ $lsvalue }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center table-responsive text-nowrap" id="Hr">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" class="form-check-input jsCheckAll"></th>
                                <th class="text-center">Employee Name</th>
                                <th class="text-center">From Date - To Date</th>
                                <th class="text-center">Total Leave Day</th>
                                <th class="text-center">Manager Approval Status</th>
                                <th class="text-center">Your Approval Status</th>
                                <th class="text-center">Is Leave Cancle</th>
                                @can('edit-leave-hr')
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
            var table_id = $("#Hr");
            var delete_url = "{{ route('hr.delete') }}";

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    scrollX: true,
                    order: [],
                    ajax: {
                        url:"{{ route('hr.index') }}",
                        data: function (d) {
                            d.user_id = $('.jsEmployeeId').val(),
                            d.from_date = $('.jsFromDate').val(),
                            d.to_date = $('.jsToDate').val(),
                            d.is_approved = $('.jsApprovalStatus').val()
                        }
                    },
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        { data: 'employee_name', name: 'employee_name' },
                        { data: 'from_date_to_date', name: 'from_date_to_date'},
                        { data: 'number_of_days', name: 'number_of_days' },
                        { data: 'manager_approval_status', name: 'manager_approval_status'},
                        { data: 'hr_approval_status', name: 'hr_approval_status'},
                        { data: 'is_leave_cancle', name: 'is_leave_cancle'},
                        @can('edit-leave-hr')
                            { data: 'action', name: 'action', orderable: false, searchable: false },
                        @endcan
                    ],
                });
        
                $(".form-control").on('keyup change', function() {
                    table.draw();
                });

                $(".form-select").on('change', function() {
                    table.draw();
                });
            });
        </script>
    @endpush
