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
                        <a href="{{ route('attendancecorrection.index') }}" class="text-reset">Attendance Correction</a> /
                    </span> Edit
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form class="FormValidate" action="{{ route('attendancecorrection.update', $punchinout->id) }}" method="post">
                                @csrf 
                                @method('put')
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <label class="form-label" for="employee-name">Employee Name <span class="text-danger">*</span></label>
                                        <input type="text" name="" class="form-control" value="{{ $punchinout->user->full_name }}" readonly>
                                        <input type="hidden" name="user_id" value="{{ $punchinout->user_id }}">
                                        <input type="hidden" id="latitude" name='latitude' value="">
                                        <input type="hidden" id="longitude" name='longitude' value="">
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label for="dateRangePicker" class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" name="date" class="form-control" min="{{ $punchinout->date }}" max="{{ $punchinout->date }}" value="{{ $punchinout->date }}"/>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label for="punch-in" class="form-label">Punch In <span class="text-danger">*</span></label>
                                        <input type="time" name="punch_in" class="form-control" value="{{ $punchinout->punch_in }}"/>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label for="punch-out" class="form-label">Punch Out <span class="text-danger">*</span></label>
                                        <input type="time" name="punch_out" class="form-control" value="{{ $punchinout->punch_out }}" />
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('attendancecorrection.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
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
            getLocation();
            function getLocation() 
            {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    // If geolocation is not supported
                    document.getElementById('latitude').value = "";
                    document.getElementById('longitude').value = "";
                    console.log('Geolocation is not supported by this browser.');
                }
            }

            function showPosition(position) 
            {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }

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