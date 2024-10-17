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
                        <a href="{{ route('salary.index') }}" class="text-reset">Salary</a> /
                    </span> Import
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form class="FormValidate" action="{{ route('salary.import') }}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="basic-default-fullname">Choose File <span class="text-danger">*</span></label>
                                        <input type="file" name="import_file" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="sample-file" class="form-label">Download Sample File</label><br>
                                        <a href="{{ asset('admin/samplefiles/attendance-sample-import.xlsx') }}" class="btn btn-outline-primary" download><i class="fas fa-download"></i>&nbsp;&nbsp;Download </a>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary waves-effect">Reset</button>
                                    <a href="{{ route('salary.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script type="text/javascript">
            $.validator.addMethod("fileExtension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, "|") : "xlsx|xls|xlsm";
                return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            }, "Please Choose Only .xls file.");
            
            $('.FormValidate').validate({
                rules:{
                    'import_file': {
                        required: true,
                        fileExtension: "xlsx|xls|xlsm"
                    },
                },
                messages:{
                    'import_file': {
                        required: 'Please Select File',
                        fileExtension: 'Only .xls file Allowed'
                    },
                },
                submitHandler: function(form) {
                    $(form).find(':submit').prop('disabled', true);
                    $(form).find(':submit').text('Please Wait');
                    form.submit();
                }
            });
        </script>
    @endpush