    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                    </span>
                    <span class="text-muted fw-light">
                        <a href="{{ route('salary.index') }}" class="text-reset">Salary</a> /
                    </span>
                    <span>{{ $user->full_name }}</span>
                </h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        <a href="{{ route('salary.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                        {{-- <a href="javascript:void(0);" class="btn btn-outline-danger" id="delete-selected"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a> --}}
                        <a href="{{ route('salary.index') }}" class="btn btn-outline-danger"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
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
                                            <label class="form-label" for="collapsible-phone">Calendar</label>
                                            <input type="time" class="form-control phone-mask jsCalendar"/>
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
                    <table class="data-table table text-center" id="Salary">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" class="form-check-input jsCheckAll"></th>
                                <th class="text-center">Salary Month & Year</th>
                                <th class="text-center">Total Salary</th>
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
            var table_id = $("#Salary");
            var delete_url = "{{ route('salary.delete') }}";

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [],
                    ajax: {
                        url:"{{ route('salary.monthlist', $user->id) }}",
                        data: function (d) {
                            d.emp_id = $('.jsEmployeeId').val()
                        }
                    },
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        { data: 'month_year', name: 'month_year'},
                        { data: 'final_amount', name: 'final_amount'},
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                });
        
                $(".form-control").keyup(function(){
                    table.draw();
                });
            });
        </script>
    @endpush