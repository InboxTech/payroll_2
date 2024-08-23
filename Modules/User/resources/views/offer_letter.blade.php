<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Offer Letter</title>
        <style>
            /* General Styles */
            /* Print Styles */
            @page {
                size: A4;
                margin: 0mm 0mm !important;
            }

            @media print {
                body {
                    margin: 0;
                    width: 100%;
                    padding: 0;
                }
            }

            body {
                font-family: Arial, sans-serif;
                line-height: 1.3;
            }

            #offer-later {
                width: 100%;
                height: 100%;
            }
            .header img {
                display: block;
                width: 100%;
                height: 15%;
                position: cover;
            }

            .footer img {
                display: block;
                width: 100%;
                position: fixed;
                bottom: 0px;
            }

            .container-fluid {
                margin: 0px 40px 0px 40px;
            }

            .content h2 {
                font-size: 18px;
                margin-bottom: 8px;
            }

            .content p {
                margin-bottom: 8px;
                text-align: justify;
                font-size: 12.5px;
            }

            .sign {
                width: 100px;
            }

            .signature-section {
                margin-top: 15px;
                margin-bottom: 15px;
                font-size: 12px;
            }

            .signature {
                display: flex;
                justify-content: space-between;
            }

            .signature p {
                margin: 5px 0;
            }

            #salary-details {
                width: 100%;
                height: 100%;
            }
            #salary-details table {
                width: 100%;
                border-collapse: collapse;
                margin: 4rem 0;
            }

            #salary-details th,
            #salary-details td {
                border: 1px solid #000;
                padding: 4.9px;
            }

            #salary-details thead:nth-child(1) {
                width: 60%;
            }

            #salary-details thead:nth-child(2) {
                width: 20%;
            }

            #salary-details thead:nth-child(3) {
                width: 20%;
            }

            #salary-details th, 
            #salary-details .td-highlight {
                font-weight: 600;
                background-color: #b5c5e7;
            }

            #salary-details tr td:nth-child(2),
            #salary-details tr td:nth-child(3) {
                text-align: right;
            }

            #required-doc h2{
                font-family: "Gideon Roman", serif;
                text-align: center;
                text-decoration: underline;
            }
            #required-doc table{
                font-family: "Gideon Roman", serif;
            }
            #required-doc table {
                width: 100%;
                border-collapse: collapse;
                margin: 1.5rem 0;
            }
            #required-doc th,
            #required-doc td{
                border: 2px solid #4f81bc;
                padding: 8.9px;
            }
            #required-doc tr td:nth-child(1){
                text-align: center;
            }            
        </style>
    </head>

    <body>
        <section id="offer-later">
            <div class="header">
                <img src="{{ public_path('admin/assets/offer-letter/images/logo-img-header.png') }}" alt="">
            </div>
            <div class="container-fluid">
                <div class="content">
                    <h2>Congratulations {{ $userData->full_name }}</h2>
                    <p>We welcome you on behalf of INBOX INFOTECH PVT. LTD.</p>
                    <p>We are pleased to inform you that you have been selected for the <strong>{{ $userData->designation->name }}</strong> position at INBOX
                        INFOTECH
                        PVT. LTD. Your anticipated date of joining is scheduled <strong>on/before {{ \Carbon\Carbon::parse($userData->joining_date)->format('d M, Y')}},</strong> in accordance with
                        our
                        previous discussions. Below, we outline the proposal for your compensation package:</p>
                    <p>You will receive an annual remuneration of CTC INR <strong>{{ formatIndianNumber($userData->user_detail->gross_salary_yearly) }}/-</strong> and a monthly
                        remuneration
                        of CTC INR <strong>{{ formatIndianNumber($userData->user_detail->gross_salary_monthly) }}/-</strong></p>
                    <p>In the event that the State/Central Government enacts any legislation that provides benefits similar
                        to
                        or exceeding those offered to you under this letter, you will be entitled to the benefits that are
                        more
                        advantageous, but not both. The final decision regarding this matter will be at the discretion of
                        the
                        management.</p>
                    <p>These terms and conditions of your employment with INBOX INFOTECH PVT. LTD, as outlined in this offer
                        of
                        employment letter, take precedence over any prior representations, whether verbal or written, that
                        may
                        have been made during any meetings or interviews with any representative of the company. The
                        formalization of your employment relationship will only occur upon your acceptance of the
                        appointment
                        letter, which will be provided to you upon your commencement of employment, and the submission of
                        all
                        the required documents as outlined in Annexure II.</p>
                    <p>After successful completion of the probation of 6 months and review thereof, you will be entitled to
                        other benefits whatsoever as per the policies of the organization. Regular performance reviews will
                        be
                        done to assess your suitability.</p>
                    <p>Offer stands cancelled in case of any deviations in information shared or as per the documents
                        submitted
                        and or if you fail to report to us on or before the pre-decided date. We will have to assume that
                        you
                        have not accepted this job offer if we do not hear from you on or before {{ \Carbon\Carbon::parse($userData->joining_date)->format('d-m-Y') }}.</p>
                    <p>We are enthusiastic about the prospect of bringing you on board for the role and responsibilities
                        outlined, based on your qualifications and experience. We have every confidence that your expertise
                        will
                        prove to be a valuable asset to our organization.</p>
                    <p>We sincerely appreciate your decision to join us and eagerly anticipate the establishment of a
                        mutually
                        rewarding professional relationship.</p>
                    <p>We eagerly anticipate your valuable contributions to INBOX INFOTECH PVT. LTD. in your new role as {{ $userData->designation->name }}. Once again, congratulations on this significant achievement. We look forward to an
                        enduring
                        relationship with you.</p>

                    <p><strong>Yours Truly,<br>Ms. Payal Patel</strong></p>
                    <img src="{{ public_path('admin/assets/offer-letter/images/sign.png') }}" alt="" class="sign">
                    <p class="mb-1"><strong>MD & Chairman</strong></p>
                </div>

                <div class="signature-section">
                    <p><strong>Acceptance of employee:</strong> I have read the contents of the above letter & accept the
                        offer:
                    </p>
                    <div class="signature">
                        <p><strong>Signature:</strong> _______________________</p>
                        <p><strong>Candidate Name:</strong> {{ $userData->full_name }}</p>
                    </div>
                </div>
            </div>
            <div class="footer">
                <br>
                <img src="{{ public_path('admin/assets/offer-letter/images/offer_latter_footer_crop.jpg') }}" alt="">
            </div>
        </section>

        <section id="salary-details">
            <div class="header">
                <img src="{{ public_path('admin/assets/offer-letter/images/logo-img-header.png') }}" alt="">
            </div>
            <div class="container-fluid">
                <table>
                    <thead>
                        <th>Salary Structure</th>
                        <th>Yearly</th>
                        <th>Monthly</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Gross Salary</strong></td>
                            <td>{{ formatIndianNumber($userData->user_detail->gross_salary_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->gross_salary_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Basic</td>
                            <td>{{ formatIndianNumber($userData->user_detail->basic_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->basic_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>HRA</td>
                            <td>{{ formatIndianNumber($userData->user_detail->hra_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->hra_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Medical</td>
                            <td>{{ formatIndianNumber($userData->user_detail->medical_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->medical_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Education</td>
                            <td>{{ formatIndianNumber($userData->user_detail->education_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->education_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Conveyance</td>
                            <td>{{ formatIndianNumber($userData->user_detail->conveyance_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->conveyance_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Special Allowance</td>
                            <td>{{ formatIndianNumber($userData->user_detail->special_allowance_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->special_allowance_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Gross Salary(A)</td>
                            <td>{{ formatIndianNumber($userData->user_detail->gross_salary_A_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->gross_salary_A_monthly) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Less: Deduction</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Employee Contribution 12% of basic or <br> Rs. 1800/- whichever is less</td>
                            <td>{{ formatIndianNumber($userData->user_detail->employee_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->employee_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>ESI Employee Contribution (0.25%)</td>
                            <td>{{ formatIndianNumber($userData->user_detail->esi_employee_contribution_yearly) ?? 'NA' }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->esi_employee_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Labour Welfare Fund (Gujarat) employee</td>
                            <td>{{ formatIndianNumber($userData->user_detail->labour_welfare_employee_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->labour_welfare_employee_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Professional Tax</td>
                            <td>{{ formatIndianNumber($userData->user_detail->professional_tax_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->professional_tax_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Employee Contribution (B)</td>
                            <td>{{ formatIndianNumber($userData->user_detail->employee_contribution_B_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->employee_contribution_B_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Net Salary (C )</td>
                            <td>{{ formatIndianNumber($userData->user_detail->net_salary_C_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->net_salary_C_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>P.F. ( Employers Contribution 12% of <br>Basic or Rs 1800/- whichever is less)</td>
                            <td>{{ formatIndianNumber($userData->user_detail->employer_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->employer_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>ESI Employer Contribution</td>
                            <td>{{ formatIndianNumber($userData->user_detail->esi_employer_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->esi_employer_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Labour Welfare Fund (Gujarat) Employer</td>
                            <td>{{ formatIndianNumber($userData->user_detail->labour_welfare_employer_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->labour_welfare_employer_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Employer Contribution (D)</td>
                            <td>{{ formatIndianNumber($userData->user_detail->employer_contri_D_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->employer_contri_D_monthly) }}</td>
                        </tr>
                        <tr>
                            <td> &nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">CTC (B+C+D)</td>
                            <td>{{ formatIndianNumber($userData->user_detail->ctc_bcd_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->user_detail->ctc_bcd_monthly) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="footer">
                <img src="{{ public_path('admin/assets/offer-letter/images/offer_latter_footer_crop.jpg') }}" alt="">
            </div>
        </section>

        <section id="required-doc">
            <div class="header">
                <img src="{{ public_path('admin/assets/offer-letter/images/logo-img-header.png') }}" alt="">
            </div>
            <div class="container-fluid">
                <h2>Annexure II: Joining Formalities</h2>
                <p>
                    As part of our joining formalities, you are requested to submit the following documents preferably prior
                    your date of joining.
                </p>
                <table>
                    <thead>
                        <th>S.No</th>
                        <th>Particulars</th>
                        <th>Shared/Pending</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Updated Resume</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Background check and Authorization Form (Filled & Signed)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Copy of Accepted Offer Letter</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Pan card & Aadhar Card</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Ration Card/Electricity Bill/Tele. Bill/Water Bill (Any One)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>ID Proof- Driving License / Passport / Election card (Any one)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Educational Documents - 10th Mark sheet and Certificate</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Educational Documents - 12th Mark sheet and Certificate</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Educational Documents – Final Mark sheet and Degree Certificate</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Leaving Certificate/Birth Certificate</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Previous Employment Documents - Offer/Appointment Letter</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Previous Employment Documents – Experience/Relieving Letter</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Last three months’ Pay slips</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Passport Size Photo – 2 Professional photographs (Mandatory)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Bank details - Cheque / Passbook</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="footer">
                <br>
                <img src="{{ public_path('admin/assets/offer-letter/images/offer_latter_footer_crop.jpg') }}" alt="">
            </div>
        </section>
    </body>
</html>