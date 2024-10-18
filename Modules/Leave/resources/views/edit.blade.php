    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Leave</h4>
            
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Leave Type Edit</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('leave.update', $model->id) }}" method="post" class="jsFormValidate">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label class="form-label" for="leave-type-name">Leave Type Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="leave_type_name" value="{{ old('leave_type_name', $model->leave_type_name) }}" data-rule-required="true" data-msg-required="Please Enter Leave Type Name"/>
                                    <span class="error">{{ $errors->first('leave_type_name') }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="number-of-leaves">Number of Leaves <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control only_numbers" name="number_of_leaves" value="{{ old('number_of_leaves', $model->number_of_leaves) }}" data-rule-required="true" data-msg-required="Please Enter Number Of Leaves"/>
                                    <span class="error">{{ $errors->first('number_of_leaves') }}</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('leave.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
                @can('view-holiday-leave')
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Holiday Leave</h5>
                                @canany(['create-holiday-leave', 'view-previous-leave'])
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                        <div class="dropdown-menu">
                                            @can('create-holiday-leave')
                                                <a class="dropdown-item" href="{{ route('holidayleave.create') }}"><i class="ti ti-plus me-1"></i> Add</a>
                                            @endcan
                                            @can('view-previous-leave')
                                                <a class="dropdown-item" href="{{ route('holidayleave.previousleave') }}"><i class="ti ti-arrow-back-up me-1"></i> Previous Leaves</a>
                                            @endcan
                                        </div>
                                    </div>
                                @endcanany
                            </div>
                            <div class="table-responsive text-nowrap">
                                @livewire('holiday-leave-list')
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    @endsection

    @push('script')
        <script type="text/javascript">
            $('.jsFormValidate').validate({
                submitHandler: function(form) {
                    $(form).find(':submit').prop('disabled', true);
                    $(form).find(':submit').text('Please Wait');
                    form.submit();
                }
            });
        </script>
    @endpush