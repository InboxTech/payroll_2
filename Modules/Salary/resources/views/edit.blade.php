    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('salary.index') }}" class="text-reset">Salary</a> / 
                    </span> Edit
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('salary.update', $model->id) }}" method="post" autocomplete="off">
                                @csrf
                                @method('put')
                                <h4>Personal Details</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $model->first_name) }}"/>
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Midddle Name </label>
                                        <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $model->middle_name) }}"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $model->last_name) }}"/>
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" class="form-control" value="{{ old('email', $model->email) }}"/>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Mobile Number <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile_no" class="form-control" value="{{ old('mobile_no', $model->mobile_no) }}"/>
                                        @error('mobile_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="basic-default-fullname">Select Role <span class="text-danger">*</span></label>
                                        <select name="role" class="form-select">
                                            <option value="">Select Role</option>
                                            @foreach($roles as $key => $value)
                                                <option value="{{ $value }}" {{ $value == $model->roles->first()->name ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 p-4">
                                        <label class="switch">
                                            <span class="switch-label">Status</span>
                                            <input type="checkbox" class="switch-input" name="status" {{ $model->status == 1 ? 'checked' : '' }}/>
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on"></span>
                                                <span class="switch-off"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>                                
                                <div class="pt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection