<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Internship Offer Letter</title>
        <style>
            /* General Styles */
            body {
                font-family: Arial, sans-serif;
                margin: 0mm 0mm !important;
                width: 210mm;
                height: 297mm;
                font-size: 13px;
            }

            #confirmation-letter {
                width: 210mm;
                height: 297mm;
                position: relative;
            }

            .header img {
                display: block;
                width: 210mm;
                height: auto;
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

            .title {
                text-align: center;
                font-weight: bold;
                text-decoration: underline;
                margin: 1rem 0;
            }

            .date {
                text-align: right;
                margin-bottom: 2rem;
            }

            .sub {
                text-align: center;
                font-weight: bold;
                text-decoration: underline;
                margin: 1rem 0;
            }

            p {
                
                line-height: 1.2;
                text-align: justify;
            }
            ul{
                padding: 0rem !important;
            }
            ul li {
                list-style: none;
            }

            .sign {
                width: 6rem;
            }

            .signature-section {
                font-size: 11px;
            }

            .signature {
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
                <div class="title">
                    Internship Offer Letter
                </div>

                <div class="date">
                    Date: {!! \Carbon\Carbon::parse($userData->joining_date)->format('j') . '<sup>' . \Carbon\Carbon::parse($userData->joining_date)->format('S') . '</sup> ' . \Carbon\Carbon::parse($userData->joining_date)->format('F Y') !!}
                </div>
                <p>
                    <strong>To</strong><br>
                    {{ $userData->full_name }}<br>
                    Address: {{ $userData->temporary_address }}
                </p>
                <div class="sub">
                    Subject: Letter of Internship
                </div>
                <p>
                    We are delighted to extend an offer to you for the internship position at Inbox Infotech in Vadodara. We
                    believe that your skills and enthusiasm will be valuable additions to our team and we are excited about
                    the prospect of working with you.
                </p>
                <ul>
                    <li><strong>Internship Position:</strong> {{ $userData->designation->name }}</li>
                    <li><strong>Internship Start Date:</strong> {!! \Carbon\Carbon::parse($userData->joining_date)->format('j') . '<sup>' . \Carbon\Carbon::parse($userData->joining_date)->format('S') . '</sup> ' . \Carbon\Carbon::parse($userData->joining_date)->format('F Y') !!}</li>
                    <li><strong>Salary Stipend:</strong> {{ formatIndianNumber($userData->salary_history->where('job_type', 2)->first()->basic_monthly) }}</li>
                    <li><strong>Location:</strong> Inbox Infotech Vadodara</li>
                </ul>
                <p>
                    During your internship, you will have the opportunity to gain hands-on experience in 
                    specific areas or projects under the guidance of our experienced team members.
                </p>
                <p>
                    As an intern at Inbox Infotech, you will receive benefits, or perks associated with the internship [if applicable]. 
                </p>
                <p>
                    After the completion of your first three months as an intern, we will conduct a 
                    performance review to evaluate your progress and contributions. This review will 
                    provide an opportunity for feedback and discussion on your internship experience so far, 
                    as well as any areas for further development or growth. We believe that this ongoing 
                    assessment will help ensure that your internship with Inbox Infotech is both valuable 
                    and rewarding. If your performance meets our expectations during this period, 
                    we will be pleased to offer you a permanent position as an employee of Inbox Infotech.
                </p>
                <p>
                    To accept this internship, offer please sign and return a copy of this letter 
                    by 25-04-2024. If you have any questions or need further information, please 
                    do not hesitate to contact to HR & your Seniors.
                </p>
                <p>
                    We are confident that your internship experience at Inbox Infotech will be both 
                    rewarding and enriching, and we look forward to welcoming you to our team. 
                    Congratulations on your internship offer, and we wish you all the best for a 
                    successful and fulfilling experience with us.
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
            </div>
            <div class="footer">
                <img src="{{ public_path('admin/assets/offer-letter/images/offer_latter_footer.jpg') }}" alt="">
            </div>
        </section>
    </body>
</html>