    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Change Password</h4>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}"><i class="ti ti-user-check me-2 ti-sm"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('change_password') }}"><i class="ti-xs ti ti-lock me-1"></i> Change Password</a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">Change Password</h5>
                        <div class="card-body">
                            <form id="formAccountSettings" action="{{ route('change_password') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="old-assword">Old Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" name="old_password" id="currentPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        </div>
                                        <span class="error">{{ $errors->first('old_password') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="newPassword">New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" id="newPassword" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        </div>
                                        <span class="error">{{ $errors->first('new_password') }}</span>
                                    </div>
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="confirmPassword">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" name="confirm_new_password" id="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        </div>
                                        <span class="error">{{ $errors->first('confirm_new_password') }}</span>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        <a href="{{ route('dashboard') }}" class="btn btn-label-secondary">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Recent Devices -->
                    <div class="card mb-4 d-none">
                        <h5 class="card-header">Recent Devices</h5>
                        <div class="table-responsive">
                        <table class="table border-top">
                        <thead>
                          <tr>
                            <th class="text-truncate">Browser</th>
                            <th class="text-truncate">Device</th>
                            <th class="text-truncate">Location</th>
                            <th class="text-truncate">Recent Activities</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          <tr>
                            <td class="text-truncate">
                              <i class="ti ti-brand-windows text-info me-2 ti-sm"></i>
                              <span class="fw-medium">Chrome on Windows</span>
                            </td>
                            <td class="text-truncate">HP Spectre 360</td>
                            <td class="text-truncate">Switzerland</td>
                            <td class="text-truncate">10, July 2021 20:07</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <i class="ti ti-device-mobile text-danger me-2 ti-sm"></i>
                              <span class="fw-medium">Chrome on iPhone</span>
                            </td>
                            <td class="text-truncate">iPhone 12x</td>
                            <td class="text-truncate">Australia</td>
                            <td class="text-truncate">13, July 2021 10:10</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <i class="ti ti-brand-android text-success me-2 ti-sm"></i>
                              <span class="fw-medium">Chrome on Android</span>
                            </td>
                            <td class="text-truncate">Oneplus 9 Pro</td>
                            <td class="text-truncate">Dubai</td>
                            <td class="text-truncate">14, July 2021 15:15</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <i class="ti ti-brand-apple me-2 ti-sm"></i>
                              <span class="fw-medium">Chrome on MacOS</span>
                            </td>
                            <td class="text-truncate">Apple iMac</td>
                            <td class="text-truncate">India</td>
                            <td class="text-truncate">16, July 2021 16:17</td>
                          </tr>
                          <tr>
                            <td class="text-truncate">
                              <i class="ti ti-brand-windows text-info me-2 ti-sm"></i>
                              <span class="fw-medium">Chrome on Windows</span>
                            </td>
                            <td class="text-truncate">HP Spectre 360</td>
                            <td class="text-truncate">Switzerland</td>
                            <td class="text-truncate">20, July 2021 21:01</td>
                          </tr>
                          <tr class="border-transparent">
                            <td class="text-truncate">
                              <i class="ti ti-brand-android text-success me-2 ti-sm"></i>
                              <span class="fw-medium">Chrome on Android</span>
                            </td>
                            <td class="text-truncate">Oneplus 9 Pro</td>
                            <td class="text-truncate">Dubai</td>
                            <td class="text-truncate">21, July 2021 12:22</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!--/ Recent Devices -->
                </div>
              </div>
            </div>
    @endsection