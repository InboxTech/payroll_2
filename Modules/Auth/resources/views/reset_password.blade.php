    @extends('layout.admin_login_layout')
    @section('content')
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Reset Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="javascript:void(0);" class="app-brand-link gap-2">
                                <img src="{{ asset(getImage(getSettingData('config_company_logo'))) }}" style="width: 100%;">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">Reset Password 🔒</h4>
                        <form action="{{ route('reset_submit_password', $token) }}" method="post" class="jsFormValidate">
                            @csrf
                            <div class="mb-2 form-password-toggle">
                                <label class="form-label" for="password">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input  type="password" class="form-control" name="password" id="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" value="{{ old('password') }}"/>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <label id="password-error" class="error" for="password"></label>
                                <span class="error">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="mb-2 form-password-toggle">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"  value="{{ old('confirm_password') }}"/>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                <label class="error" for="confirm_password"></label>
                                <span class="error">{{ $errors->first('confirm_password') }}</span>
                            </div>
                            <button class="btn btn-primary d-grid w-100 mb-3">Set new password</button>
                            <div class="text-center">
                                <a href="{{ route('login') }}"><i class="ti ti-chevron-left scaleX-n1-rtl"></i>Back to login</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Reset Password -->
            </div>
        </div>
    @endsection

    @push('script')
        <script type="text/javascript">
            $('.jsFormValidate').validate({
                rules:{
                    'password':{
                        required: true,
                        minlength: 8
                    },
                    'confirm_password':{
                        required: true,
                        equalTo: "#password"
                    },
                },
                messages:{
                    'password': {
                        required: "Please Enter Password",
                        minlength: "Password must be at least 8 characters long"
                    },
                    'confirm_password': {
                        required: "Please Enter Confirm Password",
                        equalTo: "Password & Confirm Password Can Not Match"
                    }
                },
                submitHandler: function(form) {
                    $(form).find(':submit').prop('disabled', true);
                    $(form).find(':submit').text('Please Wait');
                    form.submit();
                }
            });
        </script>
    @endpush