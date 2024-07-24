    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('user.index') }}" class="text-reset">User</a> / 
                    </span> Edit
                </h4>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header pt-2">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">
                                        General
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-bank-details" role="tab" aria-selected="false">
                                        Bank Details
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-assign-leaves" role="tab" aria-selected="false">
                                        Assign Leaves
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-salary-structure" role="tab" aria-selected="false">
                                        Salary Structure
                                    </button>
                                </li>
                            </ul>
                        </div>
                        
                        <form action="{{ route('user.update', $user->id) }}" method="post" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="basic-default-fullname">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="basic-default-fullname">Midddle Name </label>
                                            <input type="text" name="middle_name" class="form-control" value="{{ $user->middle_name }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="basic-default-fullname">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="basic-default-fullname">Email <span class="text-danger">*</span></label>
                                            <input type="text" name="email" class="form-control" value="{{ $user->email }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="basic-default-fullname">Mobile Number <span class="text-danger">*</span></label>
                                            <input type="text" name="mobile_no" class="form-control only_numbers" value="{{ $user->mobile_no }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="formtabs-birthdate">Birth Date</label>
                                            <input type="text" name="dob" class="form-control flatpickr-date" placeholder="YYYY-MM-DD" value="{{ $user->dob }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="basic-default-fullname">Select Role <span class="text-danger">*</span></label>
                                            <select name="role" class="form-select">
                                                <option value="">Select Role</option>
                                                @foreach($roles as $key => $value)
                                                    <option value="{{ $value }}" @if($selectedRole == $value) selected @endif>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 p-4">
                                            <label class="switch">
                                                <span class="switch-label">Status</span>
                                                <input type="checkbox" class="switch-input" name="status" @if($user->status == 1) checked @else @endif/>
                                                <span class="switch-toggle-slider">
                                                    <span class="switch-on"></span>
                                                    <span class="switch-off"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-sm-4 mt-2">
                                            <label class="form-label" for="basic-default-fullname">Employee Id <span class="text-danger">*</span></label>
                                            <input type="text" name="emp_id" class="form-control" value="{{ $user->emp_id }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-tabs-bank-details" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="bank-name">Bank Name <span class="text-danger">*</span></label>
                                            <input type="text" name="bank_name" class="form-control" value="{{ $user->user_detail->bank_name }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="bank-branch-name">Bank Branch Name <span class="text-danger">*</span></label>
                                            <input type="text" name="bank_branch_name" class="form-control" value="{{ $user->user_detail->bank_branch_name }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="account-number">Account Number <span class="text-danger">*</span></label>
                                            <input type="text" name="account_number" class="form-control" value="{{ $user->user_detail->account_number }}"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="ifsc-code">IFSC Code <span class="text-danger">*</span></label>
                                            <input type="text" name="ifsc_code" class="form-control" value="{{ $user->user_detail->ifsc_code }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-tabs-assign-leaves" role="tabpanel">
                                    <div class="row">
                                        @foreach($user->assign_leave as $leave => $value)
                                            <div class="col-md-4">
                                                <label class="form-label" for="previlege-leave">{{ $value->leave->leave_type_name }} </label>
                                                <input type="text" name="assign_leave[{{ $value->id }}]" class="form-control" value="{{ $value->number_of_leaves }}" readonly/>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-tabs-salary-structure" role="tabpanel">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Salary Structure</th>
                                                    <th>Yearly</th>
                                                    <th>Monthly</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <tr>
                                                    <td>
                                                        <p><strong>Gross Salary</strong></p>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="gross_salary_yearly" class="form-control" value="{{ $user->user_detail->gross_salary_yearly }}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="gross_salary_monthly" class="form-control" value="{{ $user->user_detail->gross_salary_monthly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Basic</p>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="basic_yearly" class="form-control" value="{{ $user->user_detail->basic_yearly }}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="basic_monthly" class="form-control" value="{{ $user->user_detail->basic_monthly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>HRA</p>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="hra_yearly" class="form-control" value="{{ $user->user_detail->hra_yearly }}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="hra_monthly" class="form-control" value="{{ $user->user_detail->hra_monthly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Medical</p>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="medical_yearly" class="form-control" value="{{ $user->user_detail->medical_yearly }}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="medical_monthly" class="form-control" value="{{ $user->user_detail->medical_yearly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Education</p>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="education_yearly" class="form-control" value="{{ $user->user_detail->education_yearly }}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="education_monthly" class="form-control" value="{{ $user->user_detail->education_yearly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Conveyance</p>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="conveyance_yearly" class="form-control" value="{{ $user->user_detail->conveyance_yearly }}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="conveyance_monthly" class="form-control" value="{{ $user->user_detail->conveyance_monthly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Special Allowance</p>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="special_allowance_yearly" class="form-control" value="{{ $user->user_detail->special_allowance_yearly }}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="special_allowance_monthly" class="form-control" value="{{ $user->user_detail->special_allowance_monthly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Gross Salary</strong>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Less : Deduction</strong></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Employee Contribution 12% of basic of Rs. 1800/- whichever is less</td>
                                                    <td>
                                                        <input type="text" name="employee_contribution_yearly" class="form-control" value="{{ $user->user_detail->employee_contribution_yearly }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="employee_contribution_monthly" class="form-control" value="{{ $user->user_detail->employee_contribution_monthly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Professional Tax</td>
                                                    <td>
                                                        <input type="text" name="professional_yearly" class="form-control" value="{{ $user->user_detail->professional_yearly }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="professional_monthly" class="form-control" value="{{ $user->user_detail->professional_monthly }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>P.F. (Employee Controbution 12% of Basic or Rs. 1800/- which ever is less)</td>
                                                    <td>
                                                        <input type="text" name="pf_yearly" class="form-control" value="{{ $user->user_detail->pf_yearly }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="pf_monthly" class="form-control" value="{{ $user->user_detail->pf_monthly }}">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
                                </div>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    @endsection