    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Role</h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        @can('delete-role')
                            <a href="javascript:void(0);" class="btn btn-outline-danger d-none" id="delete-selected"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
                        @endcan
                        @can('create-role')
                            <a href="{{ route('role.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center table-responsive text-nowrap">
                        <thead>
                            <tr>
                                {{-- <th class="text-center"><input type="checkbox" id="select_all" class="form-check-input"></th> --}}
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Role name</th>
                                <th class="text-center">Permission Count</th>
                                @can('delete-role')
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
            var destoryUrl = "{{ route('role.delete') }}";
            
            $(function () {
                
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [[0, 'desc']],
                    ajax: "{{ route('role.index') }}",
                    columns: [
                        // {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'permission_count', name: 'permission_count', orderable: false},
                        @can('delete-role')
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        @endcan
                    ],
                });
                
                $('#select_all').on('click', function(){
                    var rows = window.table.rows({ 'search': 'applied' }).nodes();
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });
            });
        </script>
    @endpush
