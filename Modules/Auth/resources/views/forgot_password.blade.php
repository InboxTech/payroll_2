    @extends('layout.admin_login_layout')
    @section('content')
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body">
                        <div class="jsFlashMessage">
                            @include('flashmessage.flashmessage')
                        </div>
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="javascript:void(0);" class="app-brand-link gap-2">
                                <img src="{{ asset(getImage(getSettingData('config_company_logo'))) }}" style="width: 100%;">
                            </a>
                        </div>
                        <h4 class="mb-1 pt-2">Forgot Password? 🔒</h4>
                        <p class="mb-4">Enter your email and we'll send reset password link</p>
                        <form class="mb-3" action="{{ route('forgot_password') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" placeholder="Enter Your Email" autofocus />
                                <span class="error">{{ $errors->first('email') }}</span>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                        </form>
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection