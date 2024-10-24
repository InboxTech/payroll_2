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
                        <a href="{{ route('hr.index') }}" class="text-reset"> Hr</a> /
                    </span> Edit
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Leave Detail</h4>
                            <a href="{{ route('hr.editleave', $model->id) }}" class="btn btn-outline-primary float-end"><i class="ti ti-pencil"></i>&nbsp;&nbsp;Edit Leave</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Employee Name :</th>
                                            <td>{{ $model->user->full_name }} ({{ $model->user->getRoleNames()->first() }}) </td>
                                        </tr>
                                        <tr>
                                            <th>Leave Type :</th>
                                            <td>{{ $model->leave->leave_type_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>From Date :</th>
                                            <td>{{ date('d-m-Y', strtotime($model->from_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>To Date :</th>
                                            <td>{{ date('d-m-Y', strtotime($model->to_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Leave Mode :</th>
                                            <td>
                                                @foreach(config('constant.leave_mode') as $lmkey => $lmvalue)
                                                    @if($lmkey == $model->leave_mode)
                                                        {{ $lmvalue }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Day :</th>
                                            <td>{{ $model->number_of_days }}</td>
                                        </tr>
                                        <tr>
                                            <th>Reason :</th>
                                            <td>{{ $model->reason }}</td>
                                        </tr>
                                        <tr>
                                            <th>Manager Approval Status :</th>
                                            <td>
                                                @switch($model->manager_approval_status)
                                                    @case(0) 
                                                        Pending
                                                        @break;
                                                    @case(1)
                                                        Approved
                                                        @break;
                                                    @case(2)
                                                        Rejected
                                                        @break;
                                                    @default
                                                        Something went wrong
                                                @endswitch
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Leave Status</h5>
                        </div>
                        <div class="card-body">
                            <form class="jsFormValidate" action="{{ route('hr.update', $model->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-name">Is Approved <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="is_approved" class="form-select">
                                            <option value="">Select Status</option>
                                            @foreach(config('constant.leave_status') as $lskey => $lsvalue)
                                                <option value="{{ $lskey }}" @if($lskey == $model->is_approved) selected @endif>{{ $lsvalue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="number-of-paid-leaves">Number of Paid Leaves Approved<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" name="number_of_paid_leaves" class="form-control" value="{{ $model->number_of_paid_leaves }}" min="0" max="{{ $model->number_of_days }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="Remark">Remark</label>
                                    <div class="col-sm-9">
                                        <textarea name="leave_status_remark" class="form-control" rows="5">{{ $model->leave_status_remark }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    @if($model->is_approved == 0)
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    @endif
                                    <a href="{{ route('hr.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
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
            $('.jsFormValidate').validate({
                rules: {
                    leave_status: {
                        required: true
                    },
                    number_of_paid_leaves: {
                        required: true,
                    },
                },
                messages: {
                    leave_status: {
                        required: "Please Select Leave Status"
                    },
                    number_of_paid_leaves: {
                        required: "Please Enter Number Of Paid Leaves. If Not Paid Leaves add zero.",
                    },
                },
                highlight: function(element) {
                    $(element).removeClass('label .error');
                },
                submitHandler: function(form) {
                    $(form).find(':submit').prop('disabled', true);
                    $(form).find(':submit').text('Please Wait');
                    form.submit();
                }
            });
        </script>
    @endpush