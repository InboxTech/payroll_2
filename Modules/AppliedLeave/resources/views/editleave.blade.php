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
                        <a href="{{ route('appliedleave.edit', $result->id) }}" class="text-reset">Leave Edit</a> /
                    </span> Edit
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form class="FormValidate" action="{{ route('appliedleave.updateleave', $result->id) }}" method="post">
                                @csrf 
                                @method('put')
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <label class="form-label" for="basic-default-fullname">Leave Type <span class="text-danger">*</span></label>
                                        <select name="leave_id" class="form-select">
                                            <option value="">Select Leave Type</option>
                                            @foreach($leavetype as $ltkey => $ltvalue)
                                                <option value="{{ $ltkey }}" @if($ltkey == $result->leave_id) selected @endif>{{ $ltvalue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label for="dateRangePicker" class="form-label">From Date <span class="text-danger">*</span></label>
                                        <input type="date" name="from_date" class="form-control" min="{{ $result->from_date }}" value="{{ $result->from_date }}"/>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label for="dateRangePicker" class="form-label">To Date <span class="text-danger">*</span></label>
                                        <input type="date" name="to_date" class="form-control" max="{{ $result->to_date }}" min="{{ $result->from_date }}" value="{{ $result->to_date }}"/>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label class="form-label" for="basic-default-fullname">Leave Mode <span class="text-danger">*</span></label>
                                        <select name="leave_mode" class="form-select">
                                            <option value="">Select Leave Mode</option>
                                            @foreach(config('custom.leave_mode') as $lmkey => $lmvalue)
                                                <option value="{{ $lmkey }}" @if($lmkey == $result->leave_mode) selected @endif>{{ $lmvalue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label class="form-label" for="basic-default-fullname">Leave Cancle <span class="text-danger">*</span></label>
                                        <select name="is_leave_cancle" class="form-select">
                                            <option value="">Select Leave Cancle</option>
                                            @foreach(config('custom.leave_cancle') as $lckey => $lcvalue)
                                                <option value="{{ $lckey }}" @if($lckey == $result->is_leave_cancle) selected @endif>{{ $lcvalue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label class="form-label" for="basic-default-fullname">Reason <span class="text-danger">*</span></label>
                                        <textarea name="reason" class="form-control">{{ $result->reason }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('appliedleave.edit', $result->id) }}" class="btn btn-label-secondary waves-effect">Back</a>
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
                rules:{
                    'from_date': {
                        required: true
                    },
                    'to_date': {
                        required: true
                    },
                    'is_leave_cancle': {
                        required: true
                    },
                    'reason': {
                        required: true
                    },
                    'leave_id': {
                        required: true
                    },
                    'leave_mode': {
                        required: true
                    }
                },
                messages:{
                    'from_date': {
                        required: 'Please Select From Date'
                    },
                    'to_date' : {
                        required: 'Please Select To Date'
                    },
                    'is_leave_cancle': {
                        required: 'Please Select Leave Cancle'
                    },
                    'reason': {
                        required: 'Please Enter Reason'
                    },
                    'leave_id': {
                        required: 'Please Select Leave Type'
                    },
                    'leave_mode': {
                        required: 'Please Select Leave Mode'
                    },
                },
            });
        </script>
    @endpush