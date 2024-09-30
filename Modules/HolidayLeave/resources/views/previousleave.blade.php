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
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Previous Holiday Leave</h5>
                            <h5 class="mb-0"><a href="{{ route('leave.index') }}" class="btn btn-outline-danger waves-effect float-end"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a></h5>
                        </div>
                        <div class="table-responsive text-nowrap p-2">
                            <table class="data-table table text-center table-responsive text-nowrap" id="PreviousHolidayLeave">
                                <thead>
                                    <tr>
                                        <th class="text-center">Holiday Name & Date</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script type="text/javascript">
            var table_id = $("#PreviousHolidayLeave");

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    order: [],
                    ajax: {
                        url:"{{ route('holidayleave.previousleave') }}",
                        data: function (d) {
                            d.user_id = $('.jsEmployeeId').val(),
                            d.from_date = $('.jsFromDate').val(),
                            d.to_date = $('.jsToDate').val(),
                            d.is_approved = $('.jsApprovalStatus').val()
                        }
                    },
                    columns: [
                        { data: 'holiday_name', name: 'holiday_name' },
                        { data: 'status', name: 'status'},
                    ],
                    initComplete: function() {
                        $('.dataTables_filter input').attr('placeholder', 'Enter Holiday Name');
                    }
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