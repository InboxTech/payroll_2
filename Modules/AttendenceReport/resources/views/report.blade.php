    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('attendencereport.index') }}" class="text-reset">Attendence Report</a> /
                    </span> {{ $user->full_name }}
                </h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        <a href="{{ route('attendencereport.index') }}" class="btn btn-outline-danger"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl justify-content-center d-flex">
                <div class="card mb-4 w-px-500">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="col-mb-3">
                                <label class="form-label" for="basic-default-fullname">Select Month & Year </label>
                                <input type="month" name="month_year" class="form-control jsMonthYear" max="{{ date('Y-m') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive text-nowrap" id="jsReportData"></div>
            </div>            
        </div>
    @endsection
    @push('script')
        <script type="text/javascript">
            $(document).on('change', '.jsMonthYear', function() {
                var month = $(this).val();
                var user_id = {{ $user->id }};
                var token = "{{ csrf_token() }}";

                $.ajax({
                    url:"{{ route('attendencereport.report_details') }}",
                    dataType: "html",
                    type: "post",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'monthYear': $(this).val(),
                        'user_id': "{{ $user->id }}",
                    },
                    success:function(response) {
                        $('#jsReportData').html(response);
                    }
                });
            });
        </script>
    @endpush