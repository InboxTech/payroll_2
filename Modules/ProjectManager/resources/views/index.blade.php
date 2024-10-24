    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Project Manager</h4>
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
                    <table class="data-table table text-center table-responsive text-nowrap" id="ProjectManager">
                        <thead>
                            <tr>
                                <th class="text-center">Employee Name</th>
                                <th class="text-center">Leave Type Name</th>
                                <th class="text-center">From Date - To Date</th>
                                <th class="text-center">Total Leave Day</th>
                                <th class="text-center">Approval Status</th>
                                <th class="text-center">Is Leave Cancle</th>
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
            var table_id = $("#ProjectManager");
            var delete_url = "{{ route('projectmanager.delete') }}";

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [],
                    ajax: {
                        url:"{{ route('projectmanager.index') }}",
                        data: function (d) {
                            d.user_id = $('.jsEmployeeId').val(),
                            d.from_date = $('.jsFromDate').val(),
                            d.to_date = $('.jsToDate').val(),
                            d.is_approved = $('.jsApprovalStatus').val()
                        }
                    },
                    columns: [
                        { data: 'employee_name', name: 'employee_name' },
                        { data: 'leave_type_name', name: 'leave_type_name' },
                        { data: 'from_date_to_date', name: 'from_date_to_date'},
                        { data: 'number_of_days', name: 'number_of_days' },
                        { data: 'approval_status', name: 'approval_status'},
                        { data: 'is_leave_cancle', name: 'is_leave_cancle'},
                        { data: 'action', name: 'action', orderable: false, searchable: false },                        
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