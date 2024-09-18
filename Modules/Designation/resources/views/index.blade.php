    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Designation</h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        @can('create-designation')
                            <a href="javascript:void(0);" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addNew"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addNew" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Add New Designation</h3>
                            </div>
                            <form action="{{ route('designation.store') }}" method="POST" class="row g-3 FormValidate" autocomplete="off">
                                @csrf
                                <div class="col-12">
                                    <label class="form-label w-100" for="designation-name">Designation Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" data-rule-required="true" data-msg-required="Please Enter Designation Name"/>
                                </div>
                                <div class="col-12 col-md-12">
                                    <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select" data-rule-required="true" data-msg-required="Please Select Status">
                                        <option value="">Select Status</option>
                                        @foreach(status() as $skey => $svalue)
                                            <option value="{{ $skey }}">{{ $svalue }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Model End -->
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center table-responsive text-nowrap" id="Designation">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Designation Name</th>
                                <th class="text-center">Status</th>
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
            var table_id = $("#Designation");
            var status_url = "{{ route('designation.change_status') }}";

            $(function () {                
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [[0, 'desc']],
                    ajax: "{{ route('designation.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        { data: 'status', name: 'status' },
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                });
                
                $('#select_all').on('click', function(){
                    var rows = window.table.rows({ 'search': 'applied' }).nodes();
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });
            });

            $('.FormValidate').validate({
                submitHandler: function(form) {
                    $(form).find(':submit').prop('disabled', true);
                    $(form).find(':submit').text('Please Wait');
                    form.submit();
                }
            });
        </script>
    @endpush
