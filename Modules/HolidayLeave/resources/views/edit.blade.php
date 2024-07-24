    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Holiday Leave / Edit</h4>
            
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Leave Type</h5>
                            <h5 class="mb-0"><a href="{{ route('role.create') }}" class="float-end"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a></h5>
                        </div>
                        <div class="table-responsive text-nowrap">
                            @livewire('leave-list')
                        </div>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Holiday Leave Edit</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('holidayleave.update', $model->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label class="form-label" for="leave-type-name">Holiday Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="holiday_name" value="{{ old('holiday_name', $model->holiday_name) }}"/>
                                    <span class="error">{{ $errors->first('holiday_name') }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="number-of-leaves">Holiday Date <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="holiday_date" value="{{ old('holiday_date', $model->holiday_date) }}" placeholder="YYYY-MM-DD" id="flatpickr-date"/>
                                    <span class="error">{{ $errors->first('holiday_date') }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="number-of-leaves">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select">
                                        <option value=""  @if(old('status', $model->status) === '') selected @endif>Select Status</option>
                                        <option value="1" @if(old('status', $model->status) == 1) selected @endif>Active</option>
                                        <option value="0" @if(old('status', $model->status) == 0) selected @endif>Inactive</option>
                                    </select>
                                    <span class="error">{{ $errors->first('status') }}</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('leave.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection