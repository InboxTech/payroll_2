    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('user.index') }}" class="text-reset">Employee</a>
                    </span> / Salary History / {{ $userData->full_name }}
                </h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        @can('delete-employee')
                            <a href="{{ route('user.index') }}" class="btn btn-outline-danger"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="accordion mt-3" id="accordionExample">
                        @foreach($salHistoryData as $key => $value)
                            <div class="card accordion-item @if($key == 0) active @endif">
                                <h2 class="accordion-header" id="heading{{ $key }}">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion{{ $key }}" aria-expanded="@if($key == 0) true @else false @endif" aria-controls="accordion{{ $key }}">
                                        {{ $value->year }} &nbsp;&nbsp;&nbsp;&nbsp; 
                                        @if($value->job_type == 2)
                                            Internship Stipend
                                        @endif
                                    </button>
                                </h2>
                                <div id="accordion{{ $key }}" class="accordion-collapse collapse @if($key == 0) show @endif" @if($key != 0) aria-labelledby="heading{{ $key }}" @endif data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
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
                                                            {{ formatIndianNumber($value->gross_salary_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->gross_salary_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p>Basic</p>
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->basic_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->basic_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p>HRA</p>
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->hra_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->hra_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p>Medical</p>
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->medical_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->medical_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p>Education</p>
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->education_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->education_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p>Conveyance</p>
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->conveyance_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->conveyance_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p>Special Allowance</p>
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->special_allowance_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->special_allowance_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Gross Salary (A)</strong>
                                                        </td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->gross_salary_A_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->gross_salary_A_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Less : Deduction</strong></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Do you want to Deduct PF?</strong></td>
                                                        <td>
                                                            <select name="is_pf_deduct_yearly" class="form-select" disabled>
                                                                <option value="">Select Deduct PF</option>
                                                                <option value="Yes" {{ (old('is_pf_deduct_yearly', $value->is_pf_deduct_yearly ?? '') == 'Yes') ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ (old('is_pf_deduct_yearly', $value->is_pf_deduct_yearly ?? '') == 'No') ? 'selected' : '' }}>Not Deduct</option>
                                                                <option value="Fix" {{ (old('is_pf_deduct_yearly', $value->is_pf_deduct_yearly ?? '') == 'Fix') ? 'selected' : '' }}>Fix Deduct</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="is_pf_deduct_monthly" class="form-select" disabled>
                                                                <option value="">Select Deduct PF</option>
                                                                <option value="Yes" {{ (old('is_pf_deduct_monthly', $value->is_pf_deduct_monthly ?? '') == 'Yes') ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ (old('is_pf_deduct_monthly', $value->is_pf_deduct_monthly ?? '') == 'No') ? 'selected' : '' }}>Not Deduct</option>
                                                                <option value="Fix" {{ (old('is_pf_deduct_monthly', $value->is_pf_deduct_monthly ?? '') == 'Fix') ? 'selected' : '' }}>Fix Deduct</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Employee Contribution 12% of basic of Rs. 1800/- whichever is less</td>
                                                        <td>
                                                            {{ formatIndianNumber($value->employee_contribution_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->employee_contribution_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ESI Employee Contribution (0.25%)</td>
                                                        <td>
                                                            {{ formatIndianNumber($value->esi_employee_contribution_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->esi_employee_contribution_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Labour Welfare Fund (Gujarat) employee Contribution</td>
                                                        <td>
                                                            {{ formatIndianNumber($value->labour_welfare_employee_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->labour_welfare_employee_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Professional Tax</td>
                                                        <td>
                                                            {{ formatIndianNumber($value->professional_tax_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->professional_tax_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Employee Contribution (B)</strong></td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->employee_contribution_B_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->employee_contribution_B_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Net Salary (C)</strong></td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->net_salary_C_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->net_salary_C_monthly) }}                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>P.F. (Employers Controbution 12% of Basic or Rs. 1800/- which ever is less)</td>
                                                        <td>
                                                            {{ formatIndianNumber($value->employer_contribution_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->employer_contribution_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ESI Employer Contribution</td>
                                                        <td>
                                                            {{ formatIndianNumber($value->esi_employer_contribution_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->esi_employer_contribution_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Labour Welfare Fund (Gujarat) Employer Contribution</td>
                                                        <td>
                                                            {{ formatIndianNumber($value->labour_welfare_employer_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ formatIndianNumber($value->labour_welfare_employer_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Employer Contribution (D)</td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->employer_contri_D_yearly) }}
                                                        </td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->employer_contri_D_monthly) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CTC (B+C+D)</td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.formatIndianNumber($value->ctc_bcd_yearly) }}                                                            
                                                        </td>
                                                        <td>
                                                            {{ config("constant.currency_symbol").' '.number_format($value->ctc_bcd_monthly ?? 0, 2) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                    Accordion Item 2
                                </button>
                            </h2>
                            <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake
                                    dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies.
                                    Jelly beans candy canes carrot cake. Fruitcake chocolate chupa chups.
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                                    Accordion Item 3
                                </button>
                            </h2>
                            <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                                    gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                                    dragée caramels. Ice cream wafer danish cookie caramels muffin.
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection