<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmation Letter</title>
        <style>
            /* General Styles */
            body {
                font-family: Arial, sans-serif;
                font-size: 10.5px;
                margin: 0mm 0mm !important;
                width: 210mm;
                height: 297mm;
            }

            p {
                margin: 6px 0;
            }

            #confirmation-letter {
                width: 210mm;
                height: 297mm;
                position: relative;
            }

            .header img,
            .footer img {
                display: block;
                width: 100%;

            }

            .footer img {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 210mm;
                height: auto;
            }

            .container-fluid {
                margin-left: 10mm;
                margin-right: 10mm;
            }

            #confirmation-letter h2 {
                text-align: center;
            }

            #confirmation-letter table {
                width: 100%;
                border-collapse: collapse;
                margin: 1rem 0;
            }

            #confirmation-letter th,
            #confirmation-letter td {
                border: 1.5px solid #000;
                padding: 3.5px;
            }

            #confirmation-letter thead:nth-child(1) {
                width: 60%;
            }

            #confirmation-letter thead:nth-child(2) {
                width: 20%;
            }

            #confirmation-letter thead:nth-child(3) {
                width: 20%;
            }

            #confirmation-letter th,
            #confirmation-letter .td-highlight {
                font-weight: 600;
                background-color: #b5c5e7;
            }

            #confirmation-letter tr td:nth-child(2),
            #confirmation-letter tr td:nth-child(3) {
                text-align: right;
            }

            .sign {
                width: 5.5rem;
            }

            .signature-section {
                font-size: 10.5px;
            }

            .emp-sign {
                display: flex;
                justify-content: space-between;
            }

            /* Print Styles */
            @page {
                size: pdf;
                margin: 0mm 0mm !important;
                width: 100%;
                height: 100%;
            }
        </style>
    </head>

    <nav>
    </nav>

    <body>
        <section id="confirmation-letter">
            <div class="header">
                <img src="{{ public_path('admin/assets/offer-letter/images/logo-img-header.png') }}" alt="">
            </div>
            <div class="container-fluid">
                <h2>CONFIRMATION LETTER</h2>
                <p>Dear {{ $userData->full_name }},</p>
                <p>We are pleased to confirm your employment with <strong>Inbox Infotech Pvt Ltd</strong> in the position of
                    {{ $userData->designation->name }}. This confirmation is based on your successful completion of all required pre-employment
                    screenings and checks.
                </p>
                <p>Your compensation will be annually {{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->gross_salary_yearly) }}/- INR and monthly payable {{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->gross_salary_monthly) }}/- INR 
                    beginning from 
                    @php 
                        use Carbon\Carbon;

                        $internshipEndDate = $userData->probation_end_date;
                        $startDate = Carbon::createFromFormat('Y-m-d', $userData->probation_end_date);

                        $nextDay = $startDate->copy()->addDay();
                        if ($nextDay->isWeekend()) {
                            // Adjust to the next Monday if it's Saturday or Sunday
                            $nextDay->modify('next monday');
                        }
                    @endphp
                    {{ $nextDay->format('d M Y') }}
                    Please give your working report to: Payal Mam & Hiren Sir.
                </p>
                <p>Please review the attached confirmation letter, which outlines the terms and conditions of your
                    employment,
                    including compensation, benefits, and any other relevant information. If you have any questions or
                    concerns,
                    please don’t hesitate to reach out to me or our HR department for clarification.
                </p>
                <p>We look forward to your contribution to <strong>Inbox Infotech Pvt Ltd</strong> and wish you every
                    success in your role.
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Salary Structure</th>
                            <th>Yearly</th>
                            <th>Monthly</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Gross Salary</strong></td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->gross_salary_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->gross_salary_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Basic</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->basic_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->basic_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>HRA</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->hra_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->hra_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Medical</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->medical_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->medical_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Education</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->education_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->education_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Conveyance</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->conveyance_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->conveyance_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Special Allowance</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->special_allowance_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->special_allowance_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Gross Salary (A)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->gross_salary_A_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->gross_salary_A_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Less: Deduction</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Employee Contribution 12% of basic gross or Rs. 1800/- whichever is less</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->employee_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->employee_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>ESI Employee Contribution (0.25%)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->esi_employee_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->esi_employee_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Labour Welfare Fund (Gujarat) Employee Contribution</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->labour_welfare_employee_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->labour_welfare_employee_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Professional Tax</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->professional_tax_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->professional_tax_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Employee Contribution (B)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->employee_contribution_B_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->employee_contribution_B_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Net Salary (C)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->net_salary_C_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->net_salary_C_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>P.F. (Employer's Contribution 12% of Basic or Rs. 1800/- whichever is less)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->employer_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->employer_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>ESI Employer Contribution</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->esi_employer_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->esi_employer_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Labour Welfare Fund (Gujarat) Employer Contribution</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->labour_welfare_employer_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->labour_welfare_employer_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Employer Contribution (D)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->employer_contri_D_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->employer_contri_D_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">CTC (B+C+D)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->ctc_bcd_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->ctc_bcd_monthly) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="signature-section">
                    <p><strong>Yours Truly,<br>Ms. Payal Patel</strong></p>
                    <img src="{{ public_path('admin/assets/offer-letter/images/sign.png') }}" alt="" class="sign">
                    <p>MD & Chairman</p>
                    <p><strong>Acceptance of employee:</strong> I have read the contents of the above letter & accept the
                        offer:
                    </p>
                    <div class="emp-sign">
                        <p>Signature: </p>
                        <p>Candidate Name: {{ $userData->full_name }}</p>
                    </div>
                </div>
            </div>
            <div class="footer">
                <img src="{{ public_path('admin/assets/offer-letter/images/offer_latter_footer.jpg') }}" alt="">
            </div>
        </section>
    </body>
</html>