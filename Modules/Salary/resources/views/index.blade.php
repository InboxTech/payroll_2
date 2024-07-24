    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Salary</h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        <a href="javascript:void(0);" class="btn btn-outline-danger" id="delete-selected"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
                        <a href="{{ route('salary.create') }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center">
                        <thead>
                            <tr>
                                <th class="text-center"><input type="checkbox" id="select_all"></th>
                                <th class="text-center">User Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Role name</th>
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
            var destoryUrl = "{{ route('salary.delete') }}";
            
            $(function () {
                
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [],
                    ajax: "{{ route('salary.index') }}",
                    columns: [
                        {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        {data: 'full_name', name: 'full_name'},
                        {data: 'email', name: 'email'},
                        {data: 'mobile_no', name: 'mobile_no'},
                        {data: 'role_name', name: 'role_name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                });
                
                $('#select_all').on('click', function(){
                    var rows = window.table.rows({ 'search': 'applied' }).nodes();
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });
            });
        </script>
    @endpush
