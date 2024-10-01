    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile') }}"><i class="ti ti-user-check me-2 ti-sm"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('change_password') }}"><i class="ti-xs ti ti-lock me-1"></i> Change Password</a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <form id="formAccountSettings" action="{{ route('profile') }}" method="post" class="jsFormValidate" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if(!empty($user->profile_image))
                                        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                    @else
                                        <img src="{{ asset('admin/assets/img/default-profile.jpg') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" name="profile_image" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                        </label>
                                        <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_name" autofocus value="{{ old('first_name', $user->first_name) }}"/>
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="firstName" class="form-label">Middle Name </label>
                                        <input class="form-control" type="text" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}"/>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"/>
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="email" value="{{ old('email', $user->email) }}"/>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="mobile_no" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                        <input class="form-control only_numbers" type="text" name="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}"/>
                                        @error('mobile_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-label-secondary">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script src="{{ asset('admin/assets/js/pages-account-settings-account.js') }}"></script>

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
