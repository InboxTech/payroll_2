    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard / Project </span>/ Deleted Project </h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        <a href="{{ route('project.index') }}" class="btn btn-outline-danger"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        @can('restore-deleted-project')
                            <a href="javascript:void(0);" class="btn btn-outline-primary jsRestoreRecords"><i class="menu-icon tf-icons ti ti-recycle"></i>Restore</a>
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
                                            <label class="form-label" for="collapsible-phone">Project Name</label>
                                            <input type="text" class="form-control jsProjectName"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="collapsible-fullname">Client Name</label>
                                            <input type="text" name="client_name" class="form-control jsClientName"/>
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
                    <table class="data-table table text-center table-responsive text-nowrap" id="Project">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" class="form-check-input jsCheckAll"></th>
                                <th class="text-center">Project Name</th>
                                <th class="text-center">Client Name</th>
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
            var table_id = $("#Project");
            var restore_url = "{{ route('project.restoreproject') }}";

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [],
                    ajax: {
                        url:"{{ route('project.removedproject') }}",
                        data: function (d) {
                            d.project_name = $('.jsProjectName').val(),
                            d.client_name = $('.jsClientName').val()
                        }
                    },
                    columns: [
                        { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        { data: 'project_name', name: 'project_name' },
                        { data: 'client_name', name: 'client_name' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                });
        
                $(".form-control").keyup(function(){
                    table.draw();
                });
            });
        </script>
    @endpush