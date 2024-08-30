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
                        <a href="{{ route('appliedleave.index') }}" class="text-reset">Applied Leave</a> /
                    </span> Edit
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Leave History</h4>
                            <a href="{{ route('appliedleave.editleave', $model->id) }}" class="btn btn-outline-primary float-end"><i class="ti ti-pencil"></i>&nbsp;&nbsp;Edit Leave</a>
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
                            <form class="FormValidate" action="{{ route('appliedleave.update', $model->id) }}" method="post">
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
                                <div class="mt-3">
                                    @if($model->is_approved == 0)
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    @endif
                                    <a href="{{ route('appliedleave.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
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
            $('.FormValidate').validate({
                rules: {
                    leave_status: {
                        required: true
                    }
                },
                messages: {
                    leave_status: {
                        required: "Please Select Leave Status"
                    }
                }
            });
        </script>
    @endpush