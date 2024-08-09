    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Salary / Employee List</h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        {{-- <a href="javascript:void(0);" class="btn btn-outline-danger" id="delete-selected"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
                        <a href="{{ route('salary.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a> --}}
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
                                            <label class="form-label" for="collapsible-phone">Employee Id</label>
                                            <input type="text" class="form-control phone-mask jsEmployeeId"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="collapsible-fullname">Name</label>
                                            <input type="text" name="full_name" class="form-control jsName"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="collapsible-email">Email (Official)</label>
                                            <input type="text" class="form-control jsEmail" name="email"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="collapsible-phone">Mobile No</label>
                                            <input type="text" class="form-control phone-mask jsMobileNo"/>
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
                                <th class="text-center">Employee Name</th>
                                <th class="text-center">Employee Id</th>
                                <th class="text-center">Email (Official)</th>
                                <th class="text-center">Mobile</th>
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
                        url:"{{ route('salary.index') }}",
                        data: function (d) {
                            d.emp_id = $('.jsEmployeeId').val(),
                            d.full_name = $('.jsName').val(),
                            d.email = $('.jsEmail').val(),
                            d.mobile_no = $('.jsMobileNo').val()
                        }
                    },
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        { data: 'full_name', name: 'full_name' },
                        { data: 'emp_id', name: 'emp_id' },
                        { data: 'email', name: 'email'},
                        { data: 'mobile_no', name: 'mobile_no'},
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                });
        
                $(".form-control").keyup(function(){
                    table.draw();
                });
            });
        </script>
    @endpush