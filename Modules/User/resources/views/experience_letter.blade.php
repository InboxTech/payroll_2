<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Experience Letter</title>
        <style>
            /* General Styles */
            body {
                font-family: Arial, sans-serif;
                margin: 0mm 0mm !important;
                width: 210mm;
                height: 297mm;
            }

            #confirmation-letter {
                width: 210mm;
                height: 297mm;
                position: relative;
            }

            .header img{
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
                margin: 30px 0;
            }

            .date {
                text-align: right;
                margin-bottom: 30px;
            }

            .salutation {
                text-align: center;
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: 30px;
            }

            p {
                font-size: 15px;
                line-height: 1.5;
                text-align: justify;
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
                    Experience Certificate and Relieving Letter
                </div>

                <div class="date">
                    Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}
                </div>

                <div class="salutation">
                    TO WHOMSOEVER IT MAY CONCERN
                </div>

                <p>
                    This is to certify that <strong>{{ $userData->full_name }}</strong>, was an employee of Inbox Infotech, Vadodara and
                    @if($userData->gender == 1) he @else she @endif had been working with us from {{ date('d M Y', strtotime($userData->joining_date)) }} to {{ date('d M Y', strtotime($userData->releaving_date)) }} as a
                    <strong>“{{ $userData->designation->name }}”</strong>.
                </p>
                <p>
                    During @if($userData->gender == 1) his @else her @endif service period we found @if($userData->gender == 1) his @else her @endif sincere and hardworking in @if($userData->gender == 1) his @else her @endif job. We relieve @if($userData->gender == 1) his @else her @endif from the
                    current responsibilities and we wish @if($userData->gender == 1) his @else her @endif all success in @if($userData->gender == 1) his @else her @endif future career.
                </p>

                <div class="signature-section">
                    <p><strong>Yours Truly,<br>Ms. Payal Patel</strong></p>
                    <img src="{{ public_path('admin/assets/offer-letter/images/sign.png') }}" alt="" class="sign">
                    <p>MD & Chairman</p>
                </div>
            </div>
            <div class="footer">
                <img src="{{ public_path('admin/assets/offer-letter/images/offer_latter_footer.jpg') }}" alt="">
            </div>
        </section>
    </body>
</html>