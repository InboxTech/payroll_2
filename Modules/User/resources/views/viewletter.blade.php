    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard / Employee</span> / View Letter </h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        @can('delete-letters')
                            <a href="javascript:void(0);" class="btn btn-outline-danger delete_records"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
                        @endcan
                        <a href="{{ route('user.index') }}" class="btn btn-outline-danger"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center table-responsive text-nowrap" id="Letters">
                        <thead>
                            <tr>
                                @can('delete-letters')
                                    <th class="text-center"><input type="checkbox" class="form-check-input jsCheckAll"></th>
                                @endcan
                                <th class="text-center">Letter Name</th>
                                <th class="text-center">View</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script type="text/javascript">
            var table_id = $("#Letters");
            var delete_url = "{{ route('user.deleteletters') }}";

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [],
                    ajax: {
                        url:"{{ route('user.viewletter', $request->userId) }}",
                    },
                    columns: [
                        @can('delete-letters')
                            { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        @endcan
                        { data: 'letter_name', name: 'letter_name', orderable: false, searchable: false },
                        { data: 'view', name: 'view', orderable: false, searchable: false},
                    ],
                });
        
                $(".form-control").keyup(function(){
                    table.draw();
                });
            });
        </script>
    @endpush