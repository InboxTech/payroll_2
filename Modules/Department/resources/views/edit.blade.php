    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('department.index') }}" class="text-reset">Department</a> / 
                    </span> Edit
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('department.update', $department->id) }}" method="post" class="FormValidate" autocomplete="off">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="department-name">Department Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" data-rule-required="true" data-msg-required="Please Enter Department Name" value="{{ $department->name }}"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select" data-rule-required="true" data-msg-required="Please Select Status">
                                            <option value="">Select Status</option>
                                            @foreach(status() as $skey => $svalue)
                                                <option value="{{ $skey }}" @if($department->status == $skey) selected @endif>{{ $svalue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('department.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
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
            $('.FormValidate').validate();
        </script>
    @endpush