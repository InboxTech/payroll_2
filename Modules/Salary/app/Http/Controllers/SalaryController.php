<?php

namespace Modules\Salary\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PunchInOut;
use App\Models\HolidayLeave;
use App\Models\Salary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use \App\Models\User;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SalaryController extends Controller
{
    public function calculateAllDaysWithSalary(Request $request)
    {
        // Present Days Caculation
        $NumberofPaidLeaves = 0;
        if($request->ajax())
        {
            $monthYear = $request->input('monthYear');
            $userId = $request->input('userId');
        }
        else
        {
            $monthYear = $request->month_year;
            $userId = $request->user_id;

            if($request->number_of_paid_leaves)
            {
                $NumberofPaidLeaves = $request->number_of_paid_leaves;
            }
        }

        $date = Carbon::parse($monthYear);

        $numberOfDays = $date->daysInMonth;

        $startDate = $date->startOfMonth()->format('Y-m-d');
        $endDate = $date->endOfMonth()->format('Y-m-d');

        $presentDaysResult = PunchInOut::where('user_id', $userId)->whereBetween('date', [$startDate, $endDate])->get();

        $fullDays = 0;
        $halfDays = 0;

        foreach($presentDaysResult as $piokey => $piovalue)
        {
            $punchIn = new Carbon($piovalue->punch_in);
            $punchOut = new Carbon($piovalue->punch_out);

            $hoursWorked = $punchOut->diffInHours($punchIn);

            if ($hoursWorked >= 6) {
                $fullDays++;
            } else {
                $halfDays++;
            }
        }

        // Count Week off
        $totalWeekOff = $this->countWeekends($date->year, $date->month);
        $data['totalWeekOff'] = $totalWeekOff;

        // paid holiday
        $paidHoliday = HolidayLeave::whereYear('holiday_date', $date->year)->whereMonth('holiday_date', $date->month)->count();
        $data['paidHoliday'] = $paidHoliday;

        $presentDays = $fullDays + ($halfDays * 0.5);
        $data['presentDays'] = $presentDays;

        if($data['presentDays'] == 0)
        {
            $data['presentDays'] = 0;
            $data['totalWeekOff'] = $totalWeekOff;
            $data['paidHoliday'] = $paidHoliday;
            $data['absentDays'] = $numberOfDays;
            $data['numberOfWorkDay'] = 0;
            $data['Basic'] = 0.00;
            $data['Hra'] = 0.00;
            $data['Medical'] = 0.00;
            $data['Education'] = 0.00;
            $data['Conveyance'] = 0.00;
            $data['SplAllowance'] = 0.00;
            $data['GrossSalaryA'] = 0.00;
            $data['EmployeeContribution'] = 0.00;
            $data['ESIEmployeeContribution'] = 0.00;
            $data['LabourEmployeeContriCurrentMonth'] = 0.00;
            $data['ProfessionalTax'] = 0.00;
            $data['EmployeeContributionB'] = 0.00;
            $data['NetSalaryC'] = 0.00;
            $data['LabourEmployerContri'] = 0.00;
            $data['EmployerContributionD'] = 0.00;
            $data['Ctcbcd'] = 0.00;
            $data['ESIEmployerContri'] = 0.00;

            return response()->json(['data' => $data, 'status' => true]);
        }

        // Absent days 
        $data['absentDays'] = $numberOfDays - ($presentDays + $totalWeekOff + $paidHoliday);

        // Number of Work Days
        $data['numberOfWorkDay'] = $presentDays + $totalWeekOff + $paidHoliday + $NumberofPaidLeaves;
        
        // Per Day Salary
        $userData = User::where('id', $userId)->with('user_detail')->first();

        $perDaySalary = $userData->user_detail->gross_salary_A_monthly / $numberOfDays;
        $data['perDaySalary'] = number_format(round($perDaySalary), 2, '.');

        // basic salary
        $data['Basic'] = ($data['numberOfWorkDay'] * $userData->user_detail->basic_monthly) / $numberOfDays;
        
        // Hra
        $data['Hra'] = ($data['numberOfWorkDay'] * $userData->user_detail->hra_monthly) / $numberOfDays;        
        
        // Medical
        $data['Medical'] = ($data['numberOfWorkDay'] * $userData->user_detail->medical_monthly) / $numberOfDays;        
        
        // Education
        $data['Education'] = ($data['numberOfWorkDay'] * $userData->user_detail->education_monthly) / $numberOfDays;        
        
        // Conveyance
        $data['Conveyance'] = ($data['numberOfWorkDay'] * $userData->user_detail->conveyance_monthly) / $numberOfDays;        
        
        // Special Allowance
        $data['SplAllowance'] = ($data['numberOfWorkDay'] * $userData->user_detail->special_allowance_monthly) / $numberOfDays;        
        
        // Gross Salary (A)
        $data['GrossSalaryA'] = $data['Basic'] + $data['Hra'] + $data['Medical'] + $data['Education'] + $data['Conveyance'] + $data['SplAllowance'];

        $data['Basic'] = number_format($data['Basic'], 2, '.', '');
        $data['Hra'] = number_format($data['Hra'], 2, '.', '');
        $data['Medical'] = number_format($data['Medical'], 2, '.', '');
        $data['Education'] = number_format($data['Education'], 2, '.', '');
        $data['Conveyance'] = number_format($data['Conveyance'], 2, '.', '');
        $data['SplAllowance'] = number_format($data['SplAllowance'], 2, '.', '');
        $GrossSalaryA = round($data['GrossSalaryA']);
        $data['GrossSalaryA'] = number_format($GrossSalaryA, 2, '.', '');
        
        // Employee Contribution 12%
        switch ($userData->user_detail->is_pf_deduct_monthly) {
            case 'Yes':
                $EmployeeContribution = ($data['Basic'] * 12) / 100;
                $data['EmployeeContribution'] = round($EmployeeContribution);
                break;
            case 'No':
                $data['EmployeeContribution'] = 0;
                break;
            case 'Fix':
                $data['EmployeeContribution'] = $userData->user_detail->employee_contribution_monthly;
                break;
            default:
                $data['EmployeeContribution'] = 0;
                break;
        }

        $data['EmployeeContribution'] = number_format($data['EmployeeContribution'], 2, '.', '');
        
        // ESI Employee Contribution
        $data['ESIEmployeeContribution'] = $userData->user_detail->esi_employee_contribution_monthly;

        // Labour Welfare Fund (Gujarat) employee
        $data['LabourEmployeeContriCurrentMonth'] = $userData->user_detail->labour_welfare_employee_monthly;

        // Professional Tax
        $data['ProfessionalTax'] = $userData->user_detail->professional_tax_monthly;

        // Employee Contribution (B)
        $EmployeeContributionB = $data['EmployeeContribution'] + $data['LabourEmployeeContriCurrentMonth'] + $data['ProfessionalTax'] + $data['ESIEmployeeContribution'];
        $data['EmployeeContributionB'] = number_format($EmployeeContributionB, 2, '.', '');

        // Net Salary (C)
        $NetSalaryC = $data['GrossSalaryA'] - ($data['EmployeeContribution'] + $data['LabourEmployeeContriCurrentMonth'] + $data['ProfessionalTax']);
        $data['NetSalaryC'] = number_format($NetSalaryC, 2, '.', '');

        // Labour Welfare Fund (Gujarat) Employer Contribution
        $data['LabourEmployerContri'] = $userData->user_detail->labour_welfare_employer_monthly;

        // Employer Contribution (D)
        $data['EmployerContributionD'] = $userData->user_detail->employer_contri_D_monthly;

        // CTC (B + C + D)
        $Ctcbcd = $data['EmployeeContributionB'] + $data['NetSalaryC'] + $data['EmployerContributionD'];
        $data['Ctcbcd'] = number_format($Ctcbcd, 2, '.', '');

        $data['ESIEmployerContri'] = $userData->user_detail->employer_contribution_monthly;

        if($request->ajax())
        {
            return response()->json(['data' => $data, 'status' => true]);
        }
        else
        {
            $salary = Salary::updateOrCreate(
                ['user_id' => $userId, 'month_year' => $monthYear],
                [
                    'user_id' => $userId,
                    'month_year' => $monthYear,
                    'present_days' => $data['presentDays'],
                    'total_week_off' => $data['totalWeekOff'],
                    'paid_holiday' => $data['paidHoliday'],
                    'number_of_paid_leaves' => $request->number_of_paid_leaves,
                    'absent_days' => $data['absentDays'],
                    'total_days' => $numberOfDays,
                    'number_of_days_work' => $data['numberOfWorkDay'],
                    'per_day_salary' => $data['perDaySalary'],
                    'basic' => $data['Basic'],
                    'hra' => $data['Hra'],
                    'medical' => $data['Medical'],
                    'education' => $data['Education'],
                    'conveyance' => $data['Conveyance'],
                    'special_allowance' => $data['SplAllowance'],
                    'gross_salary_A' => $data['GrossSalaryA'],
                    'is_pf_deduct' => $userData->user_detail->is_pf_deduct_monthly,
                    'employee_contribution' => $data['EmployeeContribution'],
                    'esi_employee_contribution' => $data['ESIEmployeeContribution'],
                    'labour_welfare_employee' => $data['LabourEmployeeContriCurrentMonth'], 
                    'professional_tax' => $data['ProfessionalTax'],
                    'employee_contri_B' => $data['EmployeeContributionB'], 
                    'net_salary_C' => $data['NetSalaryC'], 
                    'employer_contribution' => $data['EmployerContributionD'], 
                    'esi_employer_contribution' => $data['ESIEmployerContri'], 
                    'labour_welfare_employer' => $data['LabourEmployerContri'], 
                    'employee_contri_D' => $data['EmployerContributionD'], 
                    'ctc_BCD' => $data['Ctcbcd'], 
                    'final_amount' => $data['Ctcbcd'], 
                    'payment_mode' => $request->payment_mode,
                    'remark' => $request->remark,
                ]
            );

            return $salary;
        }
    }

    public function countWeekends($year, $month)
    {
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
    
        $saturdayssundays = 0;
            
        while ($startDate->lte($endDate)) {
            if ($startDate->isSaturday()) {
                $saturdayssundays++;
            }
            if ($startDate->isSunday()) {
                $saturdayssundays++;
            }
            $startDate->addDay();
        }
    
        return $saturdayssundays;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        if ($request->ajax()) {
            
            $data = User::select([
                'users.*',
                DB::raw("CONCAT(first_name, ' ', last_name) as full_name")
            ])->whereNot('id', 1);

            return Datatables::of($data)
                    ->filter(function ($query) use ($request) {
                        if ($request->has('full_name')) {
                            $query->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%" . $request->get('full_name') . "%");
                        }

                        if ($request->has('email')) {
                            $query->where('email', 'like', "%" . $request->get('email') . "%");
                        }

                        if ($request->has('mobile_no')) {
                            $query->where('mobile_no', 'like', "%" . $request->get('mobile_no') . "%");
                        }
                        
                        if ($request->has('emp_id')) {
                            $query->where('emp_id', 'like', "%" . $request->get('emp_id') . "%");
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        $btn = '<input type="checkbox" name="id[]" class="form-check-input jsCheckBoxes" value="'.$row->id.'">';
                        return $btn;
                    })
                    ->addColumn('full_name', function($row){
                        return view('salary::user_detail', compact('row'));
                    })
                    ->addColumn('action', function($row){       
                        $btn = '<a href="'.route('salary.monthlist', $row->id).'" class="btn btn-sm btn-icon item-edit" title="Salary List"><i class="text-primary menu-icon tf-icons ti ti-file-dollar"></i></a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }
        return view('salary::index');
    }

    public function employeeSalary(Request $request)
    {
        if ($request->ajax()) {
            
            $data = Salary::select('id', 'final_amount', 'month_year')->where('user_id', Auth::user()->id)->get();
    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('month_year', function($row){
                        return date('M-Y', strtotime($row->month_year));
                    })
                    ->addColumn('final_amount', function($row){
                        return config('constant.currency_symbol').' '.$row->final_amount;
                    })
                    ->addColumn('checkbox', function($row){
                        $btn = '<input type="checkbox" name="id[]" class="form-check-input jsCheckBoxes" value="'.$row->id.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                        return view('salary::action', compact('row'));
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }

        $user = User::where('id', Auth::user()->id)->first();
        
        return view('salary::monthlist', compact('user'));
    }

    public function monthlist(Request $request)
    {
        $userData = Session::put('user', $request->user);
        
        if ($request->ajax()) {
            
            $data = Salary::select('id', 'final_amount', 'month_year')->where('user_id', $request->user)->get();
    
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('month_year', function($row){
                        return date('M-Y', strtotime($row->month_year));
                    })
                    ->addColumn('final_amount', function($row){
                        return config('constant.currency_symbol').' '.$row->final_amount;
                    })
                    ->addColumn('checkbox', function($row){
                        $btn = '<input type="checkbox" name="id[]" class="form-check-input jsCheckBoxes" value="'.$row->id.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){
                        return view('salary::action', compact('row'));
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }

        $user = User::where('id', $request->user)->first();
        
        return view('salary::monthlist', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userSession = Session::get('user');
        
        $userData = User::where('id', $userSession)->with('user_detail', 'assign_leave.leave')->firstorFail();
    
        return view('salary::create', compact('userData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userSession = Session::get('user');
        $request->merge(['user_id' => $userSession]);
        
        if($this->calculateAllDaysWithSalary($request))
        {
            return redirect()->route('salary.monthlist', $userSession)->with('success', 'Salary Credited Successfully');
        }

        return redirect()->route('salary.monthlist', $userSession)->with('error', 'Oops Something Went Wrong');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('salary::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        return view('salary::edit', compact('salary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $request->merge(['user_id' => $salary->user_id]);

        if($this->calculateAllDaysWithSalary($request))
        {
            return redirect()->route('salary.monthlist', $salary->user_id)->with('success', 'Salary Update Successfully');
        }

        return redirect()->route('salary.monthlist', $salary->user_id)->with('error', 'Oops Something Went Wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
