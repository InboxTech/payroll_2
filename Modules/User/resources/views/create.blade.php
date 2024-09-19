    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('user.index') }}" class="text-reset">Employee</a>
                    </span> / Add
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
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-pf-details" role="tab" aria-selected="false">
                                        PF Details
                                    </button>
                                </li>
                                <li class="nav-item d-none">
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

                        <form action="{{ route('user.store') }}" method="post" autocomplete="off" class="FormValidate">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-4 mb-2">
                                            <label class="form-label" for="basic-default-fullname">Employee Id <span class="text-danger">*</span></label>
                                            <input type="text" name="emp_id" class="form-control" value="{{ generateEmployee() }}"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="basic-default-fullname">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="basic-default-fullname">Midddle Name </label>
                                            <input type="text" name="middle_name" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="basic-default-fullname">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="basic-default-fullname">Email (official)<span class="text-danger">*</span></label>
                                            <input type="text" name="email" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="basic-default-fullname">Mobile Number <span class="text-danger">*</span></label>
                                            <input type="text" name="mobile_no" class="form-control only_numbers"/>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="email-personal">Email (personal)</label>
                                            <input type="text" name="personal_email" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="formtabs-birthdate">Date Of Birth <span class="text-danger">*</span></label>
                                            <input type="date" name="dob" class="form-control" max="{{ date('Y-m-d') }}"/>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="basic-default-fullname">Select Role <span class="text-danger">*</span></label>
                                            <select name="role" class="form-select">
                                                <option value="">Select Role</option>
                                                @foreach($roles as $key => $value)
                                                    <option value="{{ $value }}" @selected($value == 'Employee')>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select">
                                                <option value="">Select Status</option>
                                                @foreach(status() as $skey => $svalue)
                                                    <option value="{{ $skey }}">{{ $svalue }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                            <select name="gender" class="form-select" data-rule-required="true" data-msg-required="Please Select Gender">
                                                <option value="">Select Gender</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="3">Transgender</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label for="designation-list" class="form-label">Designation <span class="text-danger">*</span></label>
                                            <select name="designation_id" class="form-select" data-rule-required="true" data-msg-required="Please Select Designation">
                                                <option value="">Select Designation</option>
                                                @foreach($designation as $dkey => $dvalue)
                                                    <option value="{{ $dkey }}">{{ $dvalue }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label for="department-list" class="form-label">Department <span class="text-danger">*</span></label>
                                            <select name="department_id" class="form-select" data-rule-required="true" data-msg-required="Please Select Department">
                                                <option value="">Select Department</option>
                                                @foreach($department as $dkey => $dvalue)
                                                    <option value="{{ $dkey }}">{{ $dvalue }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label class="form-label" for="joining-date">Joining Date <span class="text-danger">*</span></label>
                                            <input type="date" name="joining_date" class="form-control"/>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label for="job-type" class="form-label">Select Job Type <span class="text-danger">*</span></label>
                                            <select name="job_type" class="form-select" data-rule-required="true" data-msg-required="Please Select Job Type">
                                                <option value="">Select Job Type</option>
                                                <option value="1">Job</option>
                                                <option value="2">Internship</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label class="form-label" for="probation-end-date">Probation End Date or Internship End Date<span class="text-danger">*</span></label>
                                            <input type="date" name="probation_end_date" class="form-control" data-rule-required="true" data-msg-required="Please Select Probation End Date or Internship End Date"/>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label class="form-label" for="confirmation-date">Confirmation Date </label>
                                            <input type="date" name="confirmation_date" class="form-control"/>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label class="form-label" for="releaving-date">Releaving Date </label>
                                            <input type="date" name="releaving_date" class="form-control"/>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label for="is-generate-offer-letter" class="form-label">Which letter do you want to generate?</label>
                                            <select name="type_of_letter" class="form-select">
                                                <option value="">Select Option</option>
                                                <option value="1">Internship Offer Letter</option>
                                                <option value="2">Confirmation Letter</option>
                                                <option value="3">Offer Letter</option>
                                                <option value="4">Appoitment Letter</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label for="address" class="form-label">Temporary Address</label>
                                            <textarea name="temporary_address" class="form-control"></textarea>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label for="address" class="form-label">Permanent Address</label>
                                            <textarea name="permanent_address" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4>Login Details</h4>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="basic-default-password">Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" id="jsConfirmPass" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label" for="basic-default-confirm-password">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" name="confirm_password" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-tabs-bank-details" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="bank-name">Bank Name </label>
                                            <input type="text" name="bank_name" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="bank-branch-name">Bank Branch Name </label>
                                            <input type="text" name="bank_branch_name" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="account-number">Account Number </label>
                                            <input type="text" name="ac_no" class="form-control"/>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="ifsc-code">IFSC Code </label>
                                            <input type="text" name="ifsc_code" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="form-tabs-pf-details" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <label class="form-label" for="pf-number">UAN Number </label>
                                            <input type="text" name="uan_number" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="tab-pane fade" id="form-tabs-assign-leaves" role="tabpanel">
                                    <div class="row">
                                        @foreach($assignLeave as $leave => $value)
                                            <div class="col-md-4 mt-2">
                                                <label class="form-label" for="previlege-leave">{{ $value->leave_type_name }} </label>
                                                <input type="text" name="assign_leave[{{ $value->id }}]" class="form-control float_numbers" value="{{ $value->number_of_leaves }}"/>
                                            </div>
                                        @endforeach
                                    </div>
                                </div> --}}
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
                                                        <input type="number" name="gross_salary_yearly" class="form-control jsInputGrossSalYearly" data-rule-required="true" data-msg-required="Please Enter Gross Salary" value="">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="gross_salary_monthly" class="form-control jsInputGrossSalMonthly" data-rule-required="true" data-msg-required="Please Enter Gross Salary" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Basic</p>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="basic_yearly" class="form-control jsBasicYearly jsCalculateGrossSalaryYearly" data-rule-required="true" data-msg-required="Please Enter Basic" value=""/>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="basic_monthly" class="form-control jsBasicMonthly jsCalculateGrossSalaryMonthly" data-rule-required="true" data-msg-required="Please Enter Basic" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>HRA</p>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="hra_yearly" class="form-control jsCalculateGrossSalaryYearly" value=""  data-rule-required="true" data-msg-required="Please Enter HRA"/>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="hra_monthly" class="form-control jsCalculateGrossSalaryMonthly" value=""  data-rule-required="true" data-msg-required="Please Enter HRA">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Medical</p>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="medical_yearly" class="form-control jsCalculateGrossSalaryYearly" value=""  data-rule-required="true" data-msg-required="Please Enter Medical"/>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="medical_monthly" class="form-control jsCalculateGrossSalaryMonthly" value="" data-rule-required="true" data-msg-required="Please Enter Medical">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Education</p>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="education_yearly" class="form-control jsCalculateGrossSalaryYearly" value=""  data-rule-required="true" data-msg-required="Please Enter Education">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="education_monthly" class="form-control jsCalculateGrossSalaryMonthly" value="" data-rule-required="true" data-msg-required="Please Enter Education">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Conveyance</p>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="conveyance_yearly" class="form-control jsCalculateGrossSalaryYearly" value="" data-rule-required="true" data-msg-required="Please Enter Conveyance">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="conveyance_monthly" class="form-control jsCalculateGrossSalaryMonthly" value="" data-rule-required="true" data-msg-required="Please Enter Conveyance">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Special Allowance</p>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="special_allowance_yearly" class="form-control jsCalculateGrossSalaryYearly" data-rule-required="true" data-msg-required="Please Enter Special Allowance" value="">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="special_allowance_monthly" class="form-control jsCalculateGrossSalaryMonthly" data-rule-required="true" data-msg-required="Please Enter Special Allowance" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Gross Salary (A)</strong>
                                                    </td>
                                                    <td>
                                                        <span class="jsGrossSalaryYearlyA"></span>
                                                        <input type="hidden" name="gross_salary_A_yearly" class="jsInputGrossSalaryYearlyA" value="">
                                                    </td>
                                                    <td>
                                                        <span class="jsGrossSalaryMonthlyA"></span>
                                                        <input type="hidden" name="gross_salary_A_monthly" class="jsInputGrossSalaryMonthlyA" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Less : Deduction</strong></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Do you want to Deduct PF</strong></td>
                                                    <td>
                                                        <select name="is_pf_deduct_yearly" class="form-select jsIsPFDeductYearly" data-rule-required="true" data-msg-required="Please Select An Option">
                                                            <option value="">Select Deduct PF</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">Not Deduct</option>
                                                            <option value="Fix">Fix Deduct</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="is_pf_deduct_monthly" class="form-select jsIsPFDeductMonthly" data-rule-required="true" data-msg-required="Please Select An Option">
                                                            <option value="">Select Deduct PF</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">Not Deduct</option>
                                                            <option value="Fix">Fix Deduct</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Employee Contribution 12% of basic of Rs. 1800/- whichever is less</td>
                                                    <td>
                                                        <input type="number" name="employee_contribution_yearly" class="form-control jsEmployeeContributionYearly" onchange="CalculateEmpContriBNetSalYearly()" onkeyup="CalculateEmpContriBNetSalYearly()">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="employee_contribution_monthly" class="form-control jsEmployeeContributionMonthly" onchange="CalculateEmpContriBNetSalMonthly()" onkeyup="CalculateEmpContriBNetSalMonthly()">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ESI Employee Contribution (0.25%)</td>
                                                    <td>
                                                        <input type="number" name="esi_employee_contribution_yearly" class="form-control jsESIEmployeeContributionYearly" onchange="CalculateEmpContriBNetSalYearly()" onkeyup="CalculateEmpContriBNetSalYearly()" data-rule-required="true" data-msg-required="Please Enter ESI Employee Contribution">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="esi_employee_contribution_monthly" class="form-control jsESIEmployeeContributionMonthly" onchange="CalculateEmpContriBNetSalMonthly()" onkeyup="CalculateEmpContriBNetSalMonthly()" data-rule-required="true" data-msg-required="Please Enter ESI Employee Contribution">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Labour Welfare Fund (Gujarat) employee Contribution</td>
                                                    <td>
                                                        <input type="number" name="labour_welfare_employee_yearly" class="form-control jsLabourEmployeeContriYearly" onchange="CalculateEmpContriBNetSalYearly()" onkeyup="CalculateEmpContriBNetSalYearly()" data-rule-required="true" data-msg-required="Please Enter Labour Welfare Fund">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="labour_welfare_employee_monthly" class="form-control jsLabourEmployeeContriMonthly" onchange="CalculateEmpContriBNetSalMonthly()" onkeyup="CalculateEmpContriBNetSalMonthly()" data-rule-required="true" data-msg-required="Please Enter Labour Welfare Fund">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Professional Tax</td>
                                                    <td>
                                                        <input type="number" name="professional_tax_yearly" class="form-control jsProfessionalTaxYearly" onchange="CalculateEmpContriBNetSalYearly()" onkeyup="CalculateEmpContriBNetSalYearly()" data-rule-required="true" data-msg-required="Please Enter Professional Tax">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="professional_tax_monthly" class="form-control jsProfessionalTaxMonthly" onchange="CalculateEmpContriBNetSalMonthly()" onkeyup="CalculateEmpContriBNetSalMonthly()" data-rule-required="true" data-msg-required="Please Enter Professional Tax">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Employee Contribution (B)</strong></td>
                                                    <td>
                                                        <span class="jsEmployeeContributionBYearly"></span>
                                                        <input type="hidden" name="employee_contribution_B_yearly" class="jsInputEmployeeContributionBYearly" value="">
                                                    </td>
                                                    <td>
                                                        <span class="jsEmployeeContributionBMonthly"></span>
                                                        <input type="hidden" name="employee_contribution_B_monthly" class="jsInputEmployeeContributionBMonthly" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Net Salary (C)</strong></td>
                                                    <td>
                                                        <span class="jsNetSalaryCYearly"></span>
                                                        <input type="hidden" name="net_salary_C_yearly" class="jsInputNetSalaryCYearly" value="">
                                                    </td>
                                                    <td>
                                                        <span class="jsNetSalaryCMonthly"></span>
                                                        <input type="hidden" name="net_salary_C_monthly" class="jsInputNetSalaryCMonthly" value="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>P.F. (Employers Controbution 12% of Basic or Rs. 1800/- which ever is less)</td>
                                                    <td>
                                                        <input type="number" name="employer_contribution_yearly" class="form-control jsEmployerContriYearly" onchange="CalculateEmployerContriDYearly()" onkeyup="CalculateEmployerContriDYearly()">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="employer_contribution_monthly" class="form-control jsEmployerContriMonthly" onchange="CalculateEmployerContriDMonthly()" onkeyup="CalculateEmployerContriDMonthly()">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ESI Employer Contribution</td>
                                                    <td>
                                                        <input type="number" name="esi_employer_contribution_yearly" class="form-control jsESIEmployerContributionYearly" onchange="CalculateEmployerContriDYearly()" onkeyup="CalculateEmployerContriDYearly()">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="esi_employer_contribution_monthly" class="form-control jsESIEmployerContributionMonthly" onchange="CalculateEmployerContriDMonthly()" onkeyup="CalculateEmployerContriDMonthly()">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Labour Welfare Fund (Gujarat) Employer Contribution</td>
                                                    <td>
                                                        <input type="number" name="labour_welfare_employer_yearly" class="form-control jsLabourEmployerContriYearly" onchange="CalculateEmployerContriDYearly()" onkeyup="CalculateEmployerContriDYearly()">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="labour_welfare_employer_monthly" class="form-control jsLabourEmployerContriMonthly" onchange="CalculateEmployerContriDMonthly()" onkeyup="CalculateEmployerContriDMonthly()">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Employer Contribution (D)</td>
                                                    <td>
                                                        <span class="jsEmployerContributionDYearly"></span>
                                                        <input type="hidden" name="employer_contri_D_yearly" class="jsInputEmployerContriDYearly">
                                                    </td>
                                                    <td>
                                                        <span class="jsEmployerContributionDMonthly"></span>
                                                        <input type="hidden" name="employer_contri_D_monthly" class="jsInputEmployerContriDMonthly">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>CTC (B+C+D)</td>
                                                    <td>
                                                        <span class="jsCTCBCDYearly"></span>
                                                        <input type="hidden" name="ctc_bcd_yearly" class="jsInputCTCBCDYearly">
                                                    </td>
                                                    <td>
                                                        <span class="jsCTCBCDMonthly"></span>
                                                        <input type="hidden" name="ctc_bcd_monthly" class="jsInputCTCBCDMonthly">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
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
            $('body').on('change', '.jsIsPFDeductYearly', function() {
                var pfdeduct = $(this).val();
                
                switch(pfdeduct) {
                    case 'Yes':
                        calculateEmployeeContriYearly();
                        $('.jsEmployeeContributionYearly').prop("readonly", true);
                        break;
                    case 'No':
                        $('.jsEmployeeContributionYearly').val('');
                        $('.jsEmployeeContributionYearly').prop("readonly", true);
                        CalculateEmpContriBNetSalYearly();
                        break;
                    case 'Fix':
                        $('.jsEmployeeContributionYearly').removeAttr('readonly');
                        break;
                    default:
                        console.log('default');
                }
            });

            // Yearly Deduction
            function calculateEmployeeContriYearly() {
                var basicValue = parseFloat($('.jsBasicYearly').val()) || 0;
                var employeeContriYearly = basicValue * 12 / 100;
                $('.jsEmployeeContributionYearly').val(employeeContriYearly.toFixed(2));

                CalculateEmpContriBNetSalYearly();
            }

            function CalculateEmpContriBNetSalYearly() {
                var empContriYearly = parseFloat($('.jsEmployeeContributionYearly').val()) || 0;
                var esiempContriYearly = parseFloat($('.jsESIEmployeeContributionYearly').val()) || 0;
                var labourempContriYearly = parseFloat($('.jsLabourEmployeeContriYearly').val()) || 0;
                var professionalTax = parseFloat($('.jsProfessionalTaxYearly').val()) || 0;
                var InputGrossSalYearly = parseFloat($('.jsInputGrossSalYearly').val()) || 0;

                if($('body .jsIsPFDeductYearly').val() == 'No'){
                    var employeeContriB = esiempContriYearly + labourempContriYearly + professionalTax;
                } else {
                    var employeeContriB = empContriYearly + esiempContriYearly + labourempContriYearly + professionalTax;
                }

                $('.jsEmployeeContributionBYearly').text('{{ config("constant.currency_symbol") }}' + ' ' + employeeContriB.toFixed(2));
                $('.jsInputEmployeeContributionBYearly').val(employeeContriB.toFixed(2));

                var netSalC = InputGrossSalYearly - employeeContriB;

                $('.jsNetSalaryCYearly').text('{{ config("constant.currency_symbol") }}' + ' ' + netSalC.toFixed(2));
                $('.jsInputNetSalaryCYearly').val(netSalC.toFixed(2));

                calculateCTCYearly();
            }

            function CalculateEmployerContriDYearly() {
                var EmployerContriYearly = parseFloat($('.jsEmployerContriYearly').val()) || 0;
                var ESIEmployerContributionYearly = parseFloat($('.jsESIEmployerContributionYearly').val()) || 0;
                var LabourEmployerContriYearly = parseFloat($('.jsLabourEmployerContriYearly').val()) || 0;
                
                var EmployerContriDYearly = EmployerContriYearly + ESIEmployerContributionYearly + LabourEmployerContriYearly;

                $('.jsEmployerContributionDYearly').text('{{ config("constant.currency_symbol") }}' + ' ' + EmployerContriDYearly.toFixed(2));
                $('.jsInputEmployerContriDYearly').val(EmployerContriDYearly.toFixed(2));

                calculateCTCYearly();
            }

            function calculateCTCYearly() {
                var EmployeeContributionBYearly = parseFloat($('.jsInputEmployeeContributionBYearly').val()) || 0;
                var netSalaryCYearly = parseFloat($('.jsInputNetSalaryCYearly').val()) || 0;
                var EmployerContributionDYearly = parseFloat($('.jsInputEmployerContriDYearly').val()) || 0;
                
                var ctcYearly = EmployeeContributionBYearly + netSalaryCYearly + EmployerContributionDYearly;

                $('.jsCTCBCDYearly').text('{{ config("constant.currency_symbol") }}' + ' ' + ctcYearly.toFixed(2));
                $('.jsInputCTCBCDYearly').val(ctcYearly.toFixed(2));
            }

            // Monthly Deduction
            $('body').on('change', '.jsIsPFDeductMonthly', function() {
                var pfdeduct = $(this).val();
                
                switch(pfdeduct) {
                    case 'Yes':
                        calculateEmployeeContriMonthly();
                        $('.jsEmployeeContributionMonthly').prop("readonly", true);
                        break;
                    case 'No':
                        $('.jsEmployeeContributionMonthly').val('');
                        $('.jsEmployeeContributionMonthly').prop("readonly", true);
                        CalculateEmpContriBNetSalMonthly();
                        break;
                    case 'Fix':
                        $('.jsEmployeeContributionMonthly').removeAttr('readonly');
                        break;
                    default:
                        console.log('default');
                }
            });

            function calculateEmployeeContriMonthly()
            {
                var basicValue = parseFloat($('.jsBasicMonthly').val()) || 0;
                var employeeContriMonthly = basicValue * 12 / 100;
                $('.jsEmployeeContributionMonthly').val(employeeContriMonthly);

                CalculateEmpContriBNetSalMonthly();
            }

            function CalculateEmpContriBNetSalMonthly()
            {
                var empContriMonthly = parseFloat($('.jsEmployeeContributionMonthly').val()) || 0;
                var esiempContriMonthly = parseFloat($('.jsESIEmployeeContributionMonthly').val()) || 0;
                var labourempContriMonthly = parseFloat($('.jsLabourEmployeeContriMonthly').val()) || 0;
                var professionalTax = parseFloat($('.jsProfessionalTaxMonthly').val()) || 0;
                var InputGrossSalMonthly = $('.jsInputGrossSalMonthly').val();

                if($('body .jsIsPFDeductMonthly').val() == 'No'){
                    var employeeContriB = esiempContriMonthly + labourempContriMonthly + professionalTax;
                } else {
                    var employeeContriB = empContriMonthly + esiempContriMonthly + labourempContriMonthly + professionalTax;
                }

                $('.jsEmployeeContributionBMonthly').text('{{ config("constant.currency_symbol") }}'+' '+employeeContriB.toFixed(2));
                $('.jsInputEmployeeContributionBMonthly').val(employeeContriB.toFixed(2));

                var netSalC = InputGrossSalMonthly - employeeContriB;

                $('.jsNetSalaryCMonthly').text('{{ config("constant.currency_symbol") }}'+' '+netSalC.toFixed(2));
                $('.jsInputNetSalaryCMonthly').val(netSalC.toFixed(2));
                calculateCTCMonthly();
            }

            function CalculateEmployerContriDMonthly()
            {
                var EmployerContriMonthly = parseFloat($('.jsEmployerContriMonthly').val()) || 0;
                    ESIEmployerContributionMonthly = parseFloat($('.jsESIEmployerContributionMonthly').val()) || 0;
                    LabourEmployerContriMonthly = parseFloat($('.jsLabourEmployerContriMonthly').val()) || 0;
                
                var EmployerContriDMonthly = EmployerContriMonthly + ESIEmployerContributionMonthly + LabourEmployerContriMonthly;
                
                $('.jsEmployerContributionDMonthly').text('{{ config("constant.currency_symbol") }}'+' '+EmployerContriDMonthly.toFixed(2));
                $('.jsInputEmployerContriDMonthly').val(EmployerContriDMonthly.toFixed(2));
                calculateCTCMonthly()
            }

            function calculateCTCMonthly()
            {
                var EmployeeContributionBMonthly = parseFloat($('.jsInputEmployeeContributionBMonthly').val()) || 0;
                    netSalaryCMonthly = parseFloat($('.jsInputNetSalaryCMonthly').val()) || 0;
                    EmployerContributionDMonthly = parseFloat($('.jsInputEmployerContriDMonthly').val()) || 0;
                
                ctcMonthly = EmployeeContributionBMonthly + netSalaryCMonthly + EmployerContributionDMonthly;

                $('.jsCTCBCDMonthly').text('{{ config("constant.currency_symbol") }}'+' '+ctcMonthly.toFixed(2));
                $('.jsInputCTCBCDMonthly').val(ctcMonthly);
            }

            $.validator.addMethod("validEmail", function(value, element) {
                if (value == '') return true;
                var temp1;
                temp1 = true;
                var ind = value.indexOf('@');
                var str2 = value.substr(ind + 1);
                var str3 = str2.substr(0, str2.indexOf('.'));
                if (str3.lastIndexOf('-') == (str3.length - 1) || (str3.indexOf('-') != str3.lastIndexOf('-'))) return false;
                var str1 = value.substr(0, ind);
                if ((str1.lastIndexOf('_') == (str1.length - 1)) || (str1.lastIndexOf('.') == (str1.length - 1)) || (str1.lastIndexOf('-') == (str1.length - 1))) return false;
                str = /(^[a-zA-Z0-9]+[\.\.\._-]{0,1})+([a-zA-Z0-9]+[\.\.\._-]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$/;
                temp1 = str.test(value);
                return temp1;
            }, "Please Enter Valid Email Address");

            var token = "{{ csrf_token() }}";

            $('.FormValidate').validate({
                ignore: "",
                rules:{
                    'emp_id': {
                        required: true,
                        remote: {
                            data :{
                                '_token': token,
                            },
                            url: "{{ route('user_check_duplication') }}",
                            type: "post"
                        },
                    },
                    'first_name': {
                        required: true
                    },
                    'last_name': {
                        required: true
                    },
                    "email": {
                        required : true,
                        email:true,
                        validEmail:true,
                        remote:
                        {
                            data: {
                                '_token': token,
                            },
                            url: "{{ route('user_check_duplication') }}",
                            type: "post",
                        },
                    },
                    "personal_email": {
                        email:true,
                        validEmail:true,
                        remote:
                        {
                            data: {
                                '_token': token,
                            },
                            url: "{{ route('user_check_duplication') }}",
                            type: "post",
                        },
                    },
                    "mobile_no": {
                        required : true,
                        digits: true,
                        minlength:10,
                        maxlength:10,
                        remote:
                        {
                            data: {
                                '_token': token,
                            },
                            url: "{{ route('user_check_duplication') }}",
                            type: "post",
                        },
                    },
                    'dob':{
                        required: true,
                    },
                    "role": {
                        required : true,
                    },
                    "status": {
                        required : true,
                    },
                    "joining_date": {
                        required : true,
                    },
                    'password': {
                        required : true,
                    },
                    'confirm_password': {
                        required : true,
                        equalTo: "#jsConfirmPass"
                    }
                },
                messages:{
                    'emp_id': {
                        required: "Please Enter Employee Id",
                        remote: "This Employee Id Already Exist"
                    },
                    'first_name': {
                        required: 'Please Enter First Name'
                    },
                    'last_name': {
                        required: 'Please Enter Last Name'
                    },
                    "email": {
                        required: "Please Enter Email Id",
                        email:"Please Enter Valid Email Address",
                        validEmail:"Please Enter Valid Email Address",
                        remote: "This Email Already Exist."
                    },
                    "personal_email": {
                        required: "Please Enter Email Id",
                        email:"Please Enter Valid Email Address",
                        validEmail:"Please Enter Valid Email Address",
                        remote: "This Email Already Exist."
                    },
                    "mobile_no": {
                        required: "Please Enter Mobile Number",
                        minlength: jQuery.validator.format("Please enter at least {0} character"),
                        maxlength: jQuery.validator.format("Please enter at least {0} character"),
                        remote: "This Mobile Number Already Exist."
                    },
                    'dob': {
                        required: "Please Select Date Of Birth"
                    },
                    "role": {
                        required: "Please Select Role",
                    },
                    "status": {
                        required: "Please Select Status",
                    },
                    "joining_date": {
                        required: "Please Select Joinig Date",
                    },
                    'password' : {
                        required: 'Please Enter Password'
                    },
                    'confirm_password' : {
                        required: 'Please Enter Confirm Password',
                        equalTo: 'Password and Confirm Password Not Match'
                    }
                },
                highlight: function(element) {
                    $(element).removeClass('label .error');
                },
                invalidHandler: function(event, validator) {
                    var firstInvalidElement = $(validator.errorList[0].element);

                    var tabPaneId = firstInvalidElement.closest('.tab-pane').attr('id');

                    $('button[data-bs-target="#' + tabPaneId + '"]').tab('show');
                },
                submitHandler: function(form) {
                    $(form).find(':submit').prop('disabled', true);
                    $(form).find(':submit').text('Please Wait');
                    form.submit();
                }
            });

            $(document).ready(function() {
                // calculate yearly salary
                $('body').on('keyup change load', '.jsCalculateGrossSalaryYearly', function() {
                    var totalSumYearly = 0;

                    $('.jsCalculateGrossSalaryYearly').each(function() {
                        var inputVal = $(this).val();

                        if (!isNaN(inputVal) && inputVal !== '') {
                            totalSumYearly += parseFloat(inputVal);
                        }
                    });

                    $('.jsGrossSalaryYearlyA').text('{{ config("constant.currency_symbol") }} '+totalSumYearly.toFixed(2));
                    $('.jsInputGrossSalaryYearlyA').val(totalSumYearly);
                });

                // calculate monthly salary
                $('body').on('keyup change', '.jsCalculateGrossSalaryMonthly', function() {
                    var totalSumMonthly = 0;
                    
                    $('.jsCalculateGrossSalaryMonthly').each(function() {
                        var inputVal = $(this).val();

                        if (!isNaN(inputVal) && inputVal !== '') {
                            totalSumMonthly += parseFloat(inputVal);
                        }
                    });

                    $('.jsGrossSalaryMonthlyA').text('{{ config("constant.currency_symbol") }} '+totalSumMonthly);
                    $('.jsInputGrossSalaryMonthlyA').val(totalSumMonthly);
                });
            });
        </script>
    @endpush