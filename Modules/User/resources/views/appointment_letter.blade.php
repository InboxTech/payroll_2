<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Appointment Letter</title>
        <style>
            /* General Styles */
            body {
                font-family: Arial, sans-serif;
                margin: 0mm auto;
                width: 210mm;
                height: 297mm;
                font-size: 13px;
            }

            #appointment-letter {
                width: 210mm;
                height: 297mm;
                position: relative;
            }

            .header img,
            .footer img {
                display: block;
                width: 210mm;
                height: auto;
            }

            .container-fluid {
                margin-left: 10mm;
                margin-right: 10mm;
            }

            .title {
                text-align: center;
                font-weight: bold;
                text-decoration: underline;
                margin: 0.5rem 0;
            }

            .date {
                text-align: right;
                margin-bottom: 0.5rem;
            }

            .sub {
                text-align: center;
                font-weight: bold;
                text-decoration: underline;
                margin: 0.7rem 0;
            }

            .to-emp p {
                margin: 0;
                width: 15rem;
            }

            p {
                line-height: 1.2;
                text-align: justify;
            }

            .sign {
                width: 6rem;
            }

            .signature-section {
                font-size: 11px;
            }

            .signature {
                display: flex !important;
                justify-content: space-between !important;
            }

            ol {
                counter-reset: section;
                padding-left: 15px;
            }

            ol li {
                padding-right: 10px;
                padding-bottom: 6px;
                text-align: justify;
            }

            .logo {
                display: block;
                height: 4rem;
                padding-top: 5px;
                margin-bottom: 0.5rem;
                
            }
            .page-break{
                page-break-before: always;
            }

            #appointment-letter h2 {
                text-align: center;
            }

            #appointment-letter table {
                width: 100%;
                border-collapse: collapse;
                margin: 1rem 0;
            }

            #appointment-letter th,
            #appointment-letter td {
                border: 1.5px solid #000;
                padding: 4px;
            }

            #appointment-letter thead:nth-child(1) {
                width: 60%;
            }

            #appointment-letter thead:nth-child(2) {
                width: 20%;
            }

            #appointment-letter thead:nth-child(3) {
                width: 20%;
            }

            #appointment-letter th,
            #appointment-letter .td-highlight {
                font-weight: 600;
                background-color: #b5c5e7;
            }

            #appointment-letter tr td:nth-child(2),
            #appointment-letter tr td:nth-child(3) {
                text-align: right;
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
        <section id="appointment-letter">
            <div class="header">
                <img src="{{ public_path('admin/assets/offer-letter/images/logo-img-header.png') }}" alt="">
            </div>
            <div class="container-fluid">
                <div class="title">
                    Appointment Letter
                </div>

                <div class="date">
                    Date: {!! \Carbon\Carbon::parse($userData->confirmation_date)->format('j') . '<sup>' . \Carbon\Carbon::parse($userData->confirmation_date)->format('S') . '</sup> ' . \Carbon\Carbon::parse($userData->confirmation_date)->format('F Y') !!}
                </div>

                <div class="to-emp">
                    TO
                    <p>{{ $userData->full_name }}</p>
                    <p>Address: - {{ $userData->temporary_address }} </p>
                </div>
                <div class="sub">
                    Subject: Letter of Appointment
                </div>

                <strong>{{ $userData->full_name }}</strong>

                <p>
                    This has reference to your application and subsequent interviews you have had with Inbox Infotech Pvt.
                    Ltd.
                    We are pleased to appoint you as PHP Developer in our organization based at Vadodara. Your appointment
                    takes effect from {!! \Carbon\Carbon::parse($userData->confirmation_date)->format('j') . '<sup>' . \Carbon\Carbon::parse($userData->probation_end_date)->format('S') . '</sup> ' . \Carbon\Carbon::parse($userData->probation_end_date)->format('F Y') !!}.
                </p>

                <ol>
                    <li> Reporting: During the employment period you will report to “Reporting Manager” in the Inbox
                        Infotech, however the Inbox Infotech may change your reporting any time at its sole discretion
                        Emoluments & Taxes
                    </li>
                    <li>
                        <ol>
                            <li>You will be entitled to a fixed Annual remuneration of INR {{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->gross_salary_yearly) }}/- ({{ int_to_words($userData->salary_history->where('job_type', 1)->first()->gross_salary_yearly) }}) on a cost to company basis (“CTC”), including basic salary, fixed allowances
                                and other benefits applicable as per the prevailing rules and regulations and policies of
                                the Inbox Infotech governing your employment. The breakup of your fixed annual remuneration is
                                enclosed in Annexure – I.
                            </li>
                            <li> All tax liabilities, direct or indirect, state or local, whether payable in India or
                                elsewhere
                                arising out of your entire remuneration package, present or future, shall be borne by you.
                                Your salary
                                will constitute the full and complete monetary consideration and compensation for all
                                services
                                performed by you for the Inbox Infotech during the course of your employment. All the
                                expenses incurred by you on conveyance and travel for official work will be reimbursed by
                                the Inbox
                                Infotech as per prevailing reimbursement policy subject to submission of the relevant bills.
                            </li>
                        </ol>
                    </li>
                    <li>
                        Working Hours Your working hours will be 09.00AM to 06.00PM as per the current company policy. The
                        company observes a 5-day work week.
                    </li>
                    <li>
                        <ol>
                            <li>
                                Initial Posting & Transfer: Your initial place of posting will be [Current Place]. However,
                                at the sole discretion of the Inbox Infotech you may be transferred to any other location in
                                India
                                or Abroad, department, establishment, project, branch or affiliates of the Inbox Infotech in
                                such
                                capacity as the Inbox Infotech may so determine from time to time. The terms and conditions
                                of
                                employment applicable at such place of transfer shall automatically become applicable to
                                you.
                            </li>
                            <li>
                                Travel: You will be required to undertake travel for Inbox Infotech work and the Inbox
                                Infotech’s rules relating to reimbursement of travelling expenses will be applicable to you.
                            </li>
                        </ol>
                    </li>

                    <li>
                        <ol>
                            <li>
                                Probation Period
                                You will be on probation for a period of Six months from the date of your appointment. On
                                satisfactory completion of the probation period, you will be a confirmed.
                                <mark>
                                    If in the first three months of your joining in any scenario if you are found to be
                                    non-performer then you will be terminated from service with immediate effect without any
                                    notice period.
                                </mark>
                                If not confirmed after Six months, this order will continue to be in operation, and the
                                probation period will stand extended automatically till further notice.
                            </li>
                            <li>
                                Notice Period & Final Settlement
                                While on probation,<mark> after three months in any unforeseen scenario </mark>this
                                appointment may be terminated by either side by giving One Month notice, or One Month salary
                                in lieu of notice
                                period. On confirmation, this appointment may be terminated by either side by giving Three
                                Months’
                                notice or Three Months’ salary in lieu of notice period.
                                Should you resign after confirmation, the Company will have the option to accept your
                                resignation either with immediate effect, and pay you three months’ salary in lieu of notice
                                period or
                                accept it effective any day up to the end of the notice period and pay you salary for the
                                remaining
                                period from the acceptance of resignation till the end of the notice period.

                            </li>
                        </ol>
                    </li>
                </ol>

            </div>
            <div class="footer">
                <img src="{{ public_path('admin/assets/offer-letter/images/offer_latter_footer.jpg') }}" alt="">
            </div>
            <div class="container-fluid">
                <div class="page-break">
                    <img src="{{ public_path('admin/assets/offer-letter/images/inbox-logo.png') }}" class="logo" alt="">
                </div>
                <ol start="5">
                    <li>
                        <ol start="3">
                            <li>
                                Settlement will be made only after inbox assets such as laptop, mobile phones, ID cards and
                                any other assets that may belong to inbox are duty returned. As decided by management we
                                will complete
                                you full & final settlement after 45 to 90 days of LWD
                            </li>
                        </ol>
                    </li>
                    <li>
                        Termination/Resignation
                        <ol>
                            <li>
                                Inbox Infotech reserves the right to terminate your services without assigning any reasons
                                by giving one-month notice in writing or paying you monthly basic salary for one-month in
                                lieu
                                of notice. Similarly, should you desire to resign from the services of the Inbox Infotech
                                for
                                any reason whatsoever, you would be required to give one-month notice or pay monthly basic
                                salary for
                                onemonth in lieu of notice. However, the Inbox Infotech reserves the right to pay or recover
                                salary in lieu of notice period.
                                <br>
                                It may, however, be noted that Inbox Infotech has the right to withhold acceptance of your
                                resignation, in case disciplinary proceedings are pending against you or decision has been
                                taken by the competent authority to initiate disciplinary action against you.

                            </li>
                            <li>
                                Your services shall be liable to be terminated without any notice, reason or compensation,
                                if it is found that you have misrepresented, concealed or given wrong information about your
                                candidature at the time of your appointment.
                            </li>
                            <li>
                                If during the course of your employment, you are found guilty of any gross negligence,
                                insubordination, fraud or any misconduct, your services may be terminated immediately
                                without giving any notice period or payment in lieu thereof. This shall be without prejudice
                                to
                                other rights and remedies available with Inbox Infotech under the applicable laws.
                            </li>
                            <li>
                                Absence for a continuous period of 3 days without any information to the company (including
                                absence when though applied for but not granted and when overstayed for a period of 3 days)
                                would make you to lose your lien on the service and the same shall automatically come to an
                                end without any notice or intimation or compensation.
                            </li>
                            <li>
                                On termination of this contract, you will immediately give up to the Company all
                                correspondence, specifications, formulae, books, documents, market data, cost data,
                                literature, drawings, effect or records, etc. belonging to the Company or relating to
                                its business and shall not make or retain any copies of these items.
                            </li>
                        </ol>
                    </li>
                    <li>
                        That in terms of the contract of employment it is clearly understood that you shall be entitled to
                        your monthly emoluments only if you perform work according to the scheduled working hours at
                        your place of work / posting. In case, therefore, you resort to any stoppage of work, whether alone
                        or in association with others, you shall be entitled to receive wages only in proportion to the
                        working hours, during which you have actually performed work.
                    </li>
                    <li>
                        Mode of Communication & Residential Address: Your residential address as furnished by you
                        in the application has been noted in the records. Any change in your residential address must be
                        intimated within 24 hours of any change. Any communication sent at the address given by you
                        shall be deemed to have reached and served irrespective of the fact whether you do or do not in
                        fact receive the said communication.
                    </li>
                    <li>
                        Medical Fitness: Your appointment and its continuance shall be subject to your being medically
                        fit in all respects, in proof of which you shall be required to furnish a proper medical report
                        after undergoing complete body checkup from Hospital of repute. The aforesaid medical report is
                        subject to be examined by the Inbox Infotech appointed Doctor/Medical Practitioner and Inbox
                        Infotech reserves the right to decide upon your appointment based on the opinion given by
                        aforesaid Doctor/Medical Practitioner. You shall submit the said medical report on the day of
                        joining or on receiving of this appointment letter. During the subsequent period of service in case
                        you are found medically unfit to discharge your legitimate duties, you shall render yourself liable
                        to be discharged summarily from service by giving you one month’s notice or salary thereof.
                    </li>
                    <li>
                        Leave: You will be entitled to leave (for permanent employees) in accordance with the rules
                        and regulations of the Inbox Infotech as amended from time to time.
                    </li>
                    <li>
                        Bonus, ESI, Gratuity and Provident Fund: As per Govt. Rules in force from time to time.
                    </li>
                    <li>
                        Rules and Regulations:
                        <ol>
                            <li>
                                You will be governed by the rules, regulations and administrative instructions/ orders
                                (including the Code of Conduct Policy) of the Inbox Infotech as amended from time to time.
                                You shall
                                devote your full professional and business time, attention, skill and energies to the duties
                                and
                                responsibilities as identified by the Inbox Infotech and shall faithfully and diligently
                                perform such duties.
                            </li>
                            <li>
                                You acknowledge that your primary duties are to the Inbox Infotech and undertake and agree
                                that during your employment with the Inbox Infotech you shall not be, directly or
                                indirectly,
                                engaged, concerned or interested in any other trade, business or occupation whatsoever or
                                hold any
                                other executive, advisory, managerial or directorial positions or responsibilities on
                                part-time or
                                otherwise in any entity other than an entity belonging to the Inbox Infotech, unless
                                approved by the
                                Inbox Infotech in writing.
                            </li>
                            <li>
                                You will be responsible for the safe custody of all documents, manuals, kits and other
                                property
                                belonging to the Inbox Infotech that may be entrusted to and/or placed in your possession by
                                virtue of and/or during the course of your employment with the Inbox Infotech.

                            </li>
                            
                        </ol>
                    </li>
                </ol>

                <div class="page-break">
                    <img src="{{ public_path('admin/assets/offer-letter/images/inbox-logo.png') }}" class="logo" alt="">
                </div>
                <ol start="12">
                    <li>
                        <ol start="4">
                            <li>
                                It is specifically clarified that in case there is any conflict between the terms of this
                                appointment letter and the rules, regulations and administrative instructions/ orders of
                                the Inbox Infotech, the later will prevail over the terms of the appointment letter.
                            </li>
                        </ol>
                    </li>
                    
                    <li>
                        Salary Increments: Your yearly increment will be based on your performance on job and subject
                        to being found satisfactory during the past year of service in terms of efficiency, regularity,
                        punctuality and discipline. However, the same may be withheld if the performance is found
                        unsatisfactory and Inbox Infotech’s decision will be final, in this regard.
                    </li>
                    <li>
                        Retirement: The retirement age shall be 58 years or earlier if found medically unfit.
                    </li>
                    <li>
                        Credentials: Your appointment will be subject to satisfactory verification of your credentials;
                        testimonials etc. and in case it is found out that you have indulged in falsification of documents
                        in
                        any manner and / or suppressed any relevant information etc., you shall render yourself liable to
                        termination of employment forthwith.
                    </li>
                    <li>
                        Non-Solicitation and Non-Compete
                        <ol>
                            <li>
                                You hereby agree and undertake that during the term of the employment with the Inbox
                                Infotech
                                and for a period of six month following the Termination/ leaving the employment, you shall
                                not,
                                directly or indirectly, either as an individual or as a partner, employee, consultant,
                                advisor, agent,
                                contractor, director, trustee, committee member, office bearer, or shareholder (or in a
                                similar
                                capacity or function):
                            </li>
                            <ol type="a">
                                <li>
                                    induce or attempt to influence any employee, independent contractor, consultant, author,
                                    supplier, printer, content writers, distributors, dealers, agents of the Inbox Infotech
                                    and its
                                    affiliates to terminate his employment/engagement, or otherwise cease his relationship,
                                    with
                                    the Inbox Infotech and its affiliates; and
                                </li>
                                <li>
                                    Solicit the business of, divert or take away, or attempt to divert or to take away, the
                                    business
                                    or patronage of a customer or client or any other person which has a business
                                    relationship with
                                    the Inbox Infotech and its affiliates or engage.
                                </li>
                            </ol>
                            <li>
                                You hereby acknowledge that the limitations as to time and the limitations of the character
                                or
                                nature placed in this Clause are reasonable and fair and will not materially impair your
                                ability to
                                earn a livelihood.
                            </li>
                        </ol>
                    </li>
                    <li>
                        Confidentiality
                        <ol>
                            <li>
                                You shall not, except as authorized or required by your obligations in terms hereof, reveal
                                to any
                                person or entity any of the trade secrets, copyright, trade mark, patent and other
                                intellectual
                                property rights, or any information concerning the organization, business, finances, models,
                                formulas, process, research and inventions or affairs of the Inbox Infotech and/or its
                                affiliates/associates/group companies , which may come to your knowledge and/or be imparted
                                to
                                you by the Inbox Infotech during your employment here under. You shall hold in strict
                                confidence,
                                all such Confidential Information. This restriction shall survive termination/resignation of
                                your
                                employment with the Inbox Infotech without limit in point of time but shall cease to apply
                                to
                                information or knowledge which may come into public domain without any fault on your part.
                            </li>
                            <li>
                                You shall not during the term of your employment or at any time thereafter, use or permit to
                                be
                                used, any Confidential Information or transactions of the Inbox Infotech and/or its
                                affiliates/associates/group companies which may come to your knowledge and/or possession by
                                virtue of his employment with the Inbox Infotech for any purpose other than the benefit of
                                the Inbox
                                Infotech.
                            </li>
                            <li>
                                You acknowledge that the violation of any of the provisions of Confidentiality Clause hereof
                                will
                                cause irreparable loss and harm to the Inbox Infotech which cannot be reasonably or
                                adequately
                                compensated by damages in an action at law, and accordingly, the Inbox Infotech will be
                                entitled,
                                to injunctive and other equitable relief to prevent or cure any breach or threatened breach
                                thereof,
                                but no action for any such relief shall be deemed to waive the right of the Inbox Infotech
                                to an
                                action for damages.
                            </li>
                            <li>
                                Your salary details (Total Cost to Inbox Infotech) including its break-up comprising of
                                Fixed Cost,
                                Variable Cost and any other benefits e.g. Performance incentives etc. as well as any
                                quarterly,
                                half-yearly or annual assessment/evaluation of your performance forms part of Inbox
                                Infotech’s
                                confidential information. You shall hold in strict confidence, all such Confidential
                                Information and
                                during your service period shall not discuss, share or disclose in any manner whatsoever,
                                such
                                information, with any other employee of the Inbox Infotech or of its
                                affiliates/associates/group
                                companies.
                            </li>
                            <li>
                                You acknowledge that any violation of clause 16.4 above shall be treated as breach of trust
                                and
                                the Inbox Infotech reserve its right to deal with such violations in appropriate manner.
                            </li>
                        </ol>
                    </li>
                    <li>
                        Intellectual Property Rights
                        <ol>
                            <li>
                                The work product generated by you while performing the services during the term of your
                                employment, including but not limited to all electronic data, papers, worksheets, logs,
                                records,
                                reports, documents, training materials, artistic work, literary works, drawings, new
                                technology
                                developed/coined or prepared by you, shall be the sole and exclusive property of the Inbox
                                Infotech, without limiting the generality of the foregoing, the Inbox Infotech will own all
                                intellectual
                                property rights in any work, invention, discovery or design which you make or conceive:
                            </li>
                            
                        </ol>
                    </li>
                </ol>

                <div class="page-break">
                    <img src="{{ public_path('admin/assets/offer-letter/images/inbox-logo.png') }}" class="logo" alt="">
                </div>
                <ol start="18">
                    <li>
                        <ol start="2">
                            <li>
                                While employed by the Inbox Infotech and in connection with the business of the Inbox
                                Infotech or its affiliates; or
                            </li>
                            <li>
                                By using the resources, facilities, or confidential information of the Inbox Infotech or
                                its
                                affiliates/associates/group companies.
                            </li>
                        </ol>
                    </li>
                    <li>
                        <ol>
                            <li>
                                For the purpose of this clause, intellectual property rights includes, but are not limited
                                to, rights in
                                relation to or arising from patents, design registrations, trademarks and copyright. You
                                undertake
                                to execute necessary documents like deed of assignment etc. or any other documents and do
                                all
                                such acts, at the request of the Inbox Infotech that may be required to give effect to this
                                provision.
                                You shall return to the Inbox Infotech such materials upon the termination of your
                                employment or
                                at the request of the Inbox Infotech at any time during the term of your employment.
                            </li>
                        </ol>
                    </li>
                    <li>
                        On Separation: On acceptance of the separation notice, you (or your legal heirs as the case may
                        be) shall immediately submit to the Inbox Infotech before you are relieved all correspondence,
                        specifications, formula, books, documents, cost data, market data, literature, drawings, and effects
                        and shall not make or retain any copies of these items. Any other asset of the Inbox Infotech,
                        furniture, vehicle, office equipment will either be returned to the Inbox Infotech or retained on
                        payment of such money as the Inbox Infotech may decide.
                    </li>
                    <li>
                        Arbitration: All disputes arising from or in connection with your employment with the Inbox Infotech
                        and this Appointment Letter including termination thereof shall be settled by mutual discussions
                        between the In-box Infotech and you within a period of 30 (thirty) days in the jurisdiction of
                        Vadodara from the date of notice of dispute given by a party to other party. If such disputes are
                        not
                        settled through mutual discussions, then such disputes shall be settled by the sole arbitrator,
                        appointed by the Inbox Infotech, as per the provisions of Arbitration and Conciliation Act, 1996.
                        Arbitration award shall be final and binding on both the parties.
                    </li>
                </ol>

                <p>
                    The Inbox Infotech reserves the right to add to or delete any or all of the above provisions at any time
                    without notice and without assigning any reason thereof. Such changes shall become effective
                    immediately upon being notified to the employees concerned.
                </p>
                <strong><u>General</u></strong>
                <p>
                    The above terms and conditions are based on Company Policy, Procedures and other Rules and
                    Regulations currently applicable to the Company’s employees and are subject to amendments and
                    adjustments from time to time.
                    <br>
                    Please communicate your acceptance of this appointment by signing a copy of this letter and
                    returning it to us.
                    <br>
                    We welcome you to the Inbox Infotech Pvt. Ltd family and trust we will have a long and mutually
                    rewarding association.
                </p>

                <div class="signature-section">
                    <p><strong>Yours Truly,<br>Ms. Payal Patel</strong></p>
                    <img src="{{ public_path('admin/assets/offer-letter/images/sign.png') }}" alt="" class="sign">
                    <p>MD & Chairman</p>
                    <p><strong>Acceptance of employee:</strong> I have read the contents of the above letter & accept the
                        offer:
                    </p>
                    <div class="signature">
                        <p>Signature: </p>
                        <p>Candidate Name: {{ $userData->full_name }}</p>
                    </div>
                </div>
                <div class="page-break">
                    <img src="{{ public_path('admin/assets/offer-letter/images/inbox-logo.png') }}" class="logo" alt="">
                </div>
                <div class="title">
                    Annexure-I
                </div>
                <div class="sub">
                    Salary Structure of {{ $userData->full_name }}
                </div>
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
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->gross_salary_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->gross_salary_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Basic</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->basic_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->basic_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>HRA</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->hra_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->hra_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Medical</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->medical_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->medical_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Education</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->education_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->education_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Conveyance</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->conveyance_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->conveyance_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Special Allowance</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->special_allowance_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->special_allowance_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Gross Salary (A)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->gross_salary_A_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->gross_salary_A_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Less: Deduction</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Employee Contribution 12% of basic gross or Rs. 1800/- whichever is less</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->employee_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->employee_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>ESI Employee Contribution (0.25%)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->esi_employee_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->esi_employee_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Labour Welfare Fund (Gujarat) Employee Contribution</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->labour_welfare_employee_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->labour_welfare_employee_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Professional Tax</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->professional_tax_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->professional_tax_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Employee Contribution (B)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->employee_contribution_B_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->employee_contribution_B_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Net Salary (C)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->net_salary_C_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->net_salary_C_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>P.F. (Employer's Contribution 12% of Basic or Rs. 1800/- whichever is less)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->employer_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->employer_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>ESI Employer Contribution</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->esi_employer_contribution_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->esi_employer_contribution_monthly) }}</td>
                        </tr>
                        <tr>
                            <td>Labour Welfare Fund (Gujarat) Employer Contribution</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->labour_welfare_employer_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->labour_welfare_employer_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">Employer Contribution (D)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->employer_contri_D_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->employer_contri_D_monthly) }}</td>
                        </tr>
                        <tr>
                            <td class="td-highlight">CTC (B+C+D)</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->ctc_bcd_yearly) }}</td>
                            <td>{{ formatIndianNumber($userData->salary_history->where('job_type', 1)->first()->ctc_bcd_monthly) }}</td>
                        </tr>
                    </tbody>
                </table>
                <strong><u>General</u></strong>
                <ul>
                    <li>Group Accident Insurance as per policy</li>
                    <li>Life Insurance</li>
                    <li>Incentive for Non-Sales Staff</li>
                    <li>Subsidized Lunch</li>
                </ul>
            </div>
        </section>
    </body>
</html>