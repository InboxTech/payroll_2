    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Setting</h4>
            <div class="row">
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-header pt-2">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">
                                        General
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#logo" role="tab" aria-selected="false">
                                        Logo
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <form action="{{ route('setting_submit') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="formtabs-company-name">Company Name</label>
                                            <input type="text" name="config_company_name" class="form-control" value="{{ getSettingData('config_company_name') }}"/>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="formtabs-company-email">Company Email</label>
                                            <input type="text" name="config_company_email" class="form-control" value="{{ getSettingData('config_company_email') }}" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="formtabs-company-mobile-number">Company Mobile Number</label>
                                            <input type="text" name="config_company_mobile_no" class="form-control" value="{{ getSettingData('config_company_mobile_no') }}" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="formtabs-birth-date">Company Address</label>
                                            <textarea name="config_company_address" class="form-control">{{ getSettingData("config_company_address") }}</textarea>
                                        </div>
                                        {{-- <div class="col-md-6 mb-3">
                                            <label for="start-financial-year" class="form-label">Start Financial Year</label>
                                            <select name="config_start_financial_year" class="form-select">
                                                @for($month = 1; $month <= 12; $month++)
                                                    <option value="{{ $month }}" @if($month == getSettingData("config_start_financial_year")) selected @endif>{{ date("F", mktime(0, 0, 0, $month, 1)) }}</option>
                                                @endfor
                                            </select>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="logo" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="row input_image">
                                                <div class="col-md-12">
                                                    <label class="form-label" for="image">Company Logo </label>
                                                    <div class="input-group">
                                                        <input type="text" id="company-logo" class="form-control" name="config_company_logo" aria-label="Image" aria-describedby="button-image" readonly>
                                                        <input type="hidden" name="edit_config_company_logo" value="{{ getSettingData('config_company_logo') }}" class="edit_image">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary jsButtonImageClass" type="button" data-id="company-logo">Choose File</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(!empty(getSettingData('config_company_logo')))
                                                    <div class="col-md-3 mt-2" id="image-tag">
                                                        <img src="{{ asset('storage/'.getSettingData('config_company_logo')) }}" alt="" style="height:100px; width:200px">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="row input_image">
                                                <div class="col-md-12">
                                                    <label class="form-label" for="image">Fav Icon </label>
                                                    <div class="input-group">
                                                        <input type="text" id="fav_icon" class="form-control" name="config_fav_icon" aria-label="Image" aria-describedby="button-image" readonly>
                                                        <input type="hidden" name="edit_config_fav_icon" value="{{ getSettingData('config_fav_icon') }}" class="edit_image">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary jsButtonImageClass" type="button" data-id="fav_icon">Choose File</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(!empty(getSettingData('config_fav_icon')))
                                                    <div class="col-md-3 mt-2" id="image-tag">
                                                        <img src="{{ asset('storage/'.getSettingData('config_fav_icon')) }}" alt="" style="height:50px; width:50px">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="btn btn-primary me-sm-3">Submit</button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {

                $('body').on('click', '.jsButtonImageClass', function(event){
                    event.preventDefault();

                    inputId = $(this).data('id');

                    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                });
            });

            let inputId = '';

            // set file link
            function fmSetLink($url) {
                document.getElementById(inputId).value = $url;
            }
        </script>
    @endpush