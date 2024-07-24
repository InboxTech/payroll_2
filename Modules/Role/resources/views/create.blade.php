    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('role.index') }}" class="text-reset">Role</a> / 
                    </span> Add
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('role.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="basic-default-fullname">Role name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control"/>
                                    </div>
                                </div>
                                <h4 class="mt-3">Permissions</h4>
                                <div class="row">
                                    @foreach($permissions as $group => $perms)
                                        <div class="col-md-6 mt-3">
                                            <h5>{{ ucfirst($group) }}</h5>
                                            <div class="row">
                                                @foreach($perms as $permGroup)
                                                    <div class="col-md-3 d-flex gap-2 mb-3">
                                                        <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permGroup->name }}">
                                                        <label class="form-check-label" for="defaultCheck1">{{ $permGroup->name }}</label>
                                                    </div>                                                    
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('role.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection