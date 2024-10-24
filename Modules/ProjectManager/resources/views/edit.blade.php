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
                        <a href="{{ route('projectmanager.index') }}" class="text-reset"> Project Manager</a> /
                    </span> Edit
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Leave Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th>Employee Name :</th>
                                            <td>{{ $leaveapply->user->full_name }} ({{ $leaveapply->user->getRoleNames()->first() }}) </td>
                                        </tr>
                                        <tr>
                                            <th>Leave Type :</th>
                                            <td>{{ $leaveapply->leave->leave_type_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>From Date :</th>
                                            <td>{{ date('d-m-Y', strtotime($leaveapply->from_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>To Date :</th>
                                            <td>{{ date('d-m-Y', strtotime($leaveapply->to_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Leave Mode :</th>
                                            <td>
                                                @foreach(config('constant.leave_mode') as $lmkey => $lmvalue)
                                                    @if($lmkey == $leaveapply->leave_mode)
                                                        {{ $lmvalue }}
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Day :</th>
                                            <td>{{ $leaveapply->number_of_days }}</td>
                                        </tr>
                                        <tr>
                                            <th>Reason :</th>
                                            <td>{{ $leaveapply->reason }}</td>
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
                            <form class="jsFormValidate" action="{{ route('projectmanager.update', $leaveapply->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-name">Is Approved <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="manager_approval_status" class="form-select">
                                            <option value="">Select Status</option>
                                            @foreach(config('constant.leave_status') as $lskey => $lsvalue)
                                                <option value="{{ $lskey }}" @if($lskey == $leaveapply->manager_approval_status) selected @endif>{{ $lsvalue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="Remark">Remark</label>
                                    <div class="col-sm-9">
                                        <textarea name="manager_remark" class="form-control" rows="5">{{ $leaveapply->manager_remark }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    @if($leaveapply->manager_approval_status == 0)
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    @endif
                                    <a href="{{ route('projectmanager.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
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
                    manager_approval_status: {
                        required: true
                    },
                },
                messages: {
                    manager_approval_status: {
                        required: "Please Select Leave Status"
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