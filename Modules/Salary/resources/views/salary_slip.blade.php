<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>{{ getSettingData('config_company_name') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ public_path(getImage(getSettingData('config_fav_icon'))) }}" />

        <style>
            body {
                font-family: 'DejaVu Sans', sans-serif;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            .container {
                box-sizing: border-box;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 5px;
                text-align: left;
                vertical-align: top;
            }
            th {
                background-color: #f2f2f2;
                width: 30%;
            }
            tr, td {
                text-align: center;
                font-size: 12px;
                padding: 3px;
            }
            table td {
                width: 30%
            }
        </style>
    </head>
    <body>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <td>
                            <img src="{{ public_path('default_images/salary-slip-logo.png') }}" alt="">
                        </td>
                    </tr>
                </thead>
            </table>
            <table>
                <thead>
                    <tr>
                        <th colspan="4" style="text-align: center"><h3>Salary Slip for {{ \Carbon\Carbon::parse($salary->month_year)->format('M Y') }}</h3></th>
                    </tr>
                    <tr>
                        <th>Name of the Employee</th>
                        <td>{{ $salary->user->full_name }}</td>
                        <th>UAN</th>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Employee ID</th>
                        <td>{{ $salary->user->emp_id }}</td>
                        <th>PF No</th>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Designation</th>
                        <td>{{ $salary->user->designation->name }}</td>
                        <th>ESI No</th>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td>{{ $salary->user->department->name ?? '-' }}</td>
                        <th>Bank Name</th>
                        <td>{{ $salary->user->bank_name }}</td>
                    </tr>
                    <tr>
                        <th>DOJ</th>
                        <td>{{ \Carbon\Carbon::parse($salary->user->joining_date)->format('d-m-Y') }}</td>
                        <th>Bank A/C No</th>
                        <td>{{ $salary->user->account_number }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="height: 30px"></td>
                    </tr>
                    <tr>
                        <th>Total Working Days</th>
                        <td>{{ $salary->number_of_days_work }}</td>
                        <th>Paid Days</th>
                        <td>{{ $salary->total_week_off + $salary->paid_holiday }}</td>
                    </tr>
                    <tr>
                        <th>LOP Days</th>
                        <td></td>
                        <th>Leaves Taken</th>
                        <td>{{ $salary->absent_days }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="height: 30px"></td>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: center">Earning</th>
                        <th colspan="2" style="text-align: center">Deductions</th>
                    </tr>
                    <tr>
                        <th>Basic Wage</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->basic }}</td>
                        <th>EPF</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->employee_contribution }}</td>
                    </tr>
                    <tr>
                        <th>HRA</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->hra }}</td>
                        <th>Professional Tax</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->professional_tax }}</td>
                    </tr>
                    <tr>
                        <th>Conveyance Allowance</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->conveyance }}</td>
                        <th>TDS</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Medical Allowance</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->medical }}</td>
                        <th>ESI/Health Insurance</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->esi_employee_contribution }}</td>
                    </tr>
                    <tr>
                        <th>Educational Allowance</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->education }}</td>
                        <th>GLWF</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->labour_welfare_employee }}</td>
                    </tr>
                    <tr>
                        <th>Special/Other Allowance</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->special_allowance }}</td>
                        <th>Employer Contribution</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->employer_contribution }}</td>
                    </tr>
                    <tr>
                        <th>Total Earnings</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->gross_salary_A }}</td>
                        <th>Total Deductions</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->employee_contri_B }}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align: center">Net Salary</th>
                        <td style="text-align:left">&#8377;&nbsp;{{ $salary->final_amount }}</td>
                    </tr>
                </thead>
            </table>
        </div>
        <table style="margin-top: 15%">
            <tr style="border: none !important;">
                <td style="border: none !important; text-align:left;">
                    <img src="{{ public_path('default_images/noimage.png') }}" alt="" height="100px">
                </td>
                <td style="border: none !important;"></td>
            </tr>
            <tr style="border: none !important;">
                <td style="border: none !important; text-align:left;">
                    <p>Employer Signature </p>
                </td>
                <td style="border: none !important; text-align:right;">
                    <p>Employee Signature </p>
                </td>
            </tr>
        </table>
    </body>
</html>
