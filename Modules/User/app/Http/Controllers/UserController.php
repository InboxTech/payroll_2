<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\SalaryHistory;
use App\Models\Designation;
use App\Models\Department;
use App\Models\UserDetail;
use App\Models\AssignLeave;
use App\Models\Leave;
use DataTables;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-employee|create-employee|edit-employee|delete-employee', ['only' => ['index','show']]);
        $this->middleware('permission:create-employee', ['only' => ['create','store']]);
        $this->middleware('permission:edit-employee', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-employee', ['only' => ['destroy']]);
    }

    public function salaryhistory(Request $request)
    {
        $userData = User::where('id', $request->userId)->first();

        $salHistoryData = SalaryHistory::where('user_id', $request->userId)->orderBy('id', 'DESC')->get();
        
        return view('user::salaryhistory', compact('salHistoryData', 'userData'));
    }

    public function assignleaves()
    {
        $now = Carbon::now();
        $today = $now->format('Y-m-d');
        
        $users = User::where(['status' => 1], ['job_type' => 1])->where('probation_end_date', $today)->get();
        $leaveList = Leave::get();
        $totalLeaves = Leave::sum('number_of_leaves');
        $monthsInYear = 12;

        foreach ($users as $user) {
            $probationEndDate = Carbon::createFromDate($user->probation_end_date);
            $probationMonth = $probationEndDate->month;
            $remainingMonths = 12 - $probationMonth;

            $calculatedLeaves = ($totalLeaves / $monthsInYear) * $remainingMonths;

            foreach ($leaveList as $leave) {
                $assignedLeave = 0;

                switch ($leave->id) {
                    // Privilege Leave (PL)
                    case 1:
                        if ($remainingMonths > 2) {
                            $assignedLeave = ($calculatedLeaves * $leave->number_of_leaves) / $totalLeaves; // Distribute based on PL proportion

                            // check probation end in Jun to Dec
                            if($remainingMonths <= 7) {
                                $assignedLeave -= 1;
                            }
                        } else {
                            $assignedLeave = 0;
                        }

                        break;
                    // Sick Leave (SL)
                    case 2:

                    // Casual Leave (CL)
                    case 3:
                        // $assignedLeave = ($calculatedLeaves * $leave->number_of_leaves) / $totalLeaves;
                        $assignedLeave = $leave->number_of_leaves / $monthsInYear * $remainingMonths;

                        $assignedLeave = ceil($assignedLeave);

                        break;
                    default:
                        $assignedLeave = 0;
                        break;
                }

                if ($remainingMonths == 0) {
                    $assignedLeave = $leave->number_of_leaves;
                }

                $rounded = floor($assignedLeave);

                $fractional = $assignedLeave - $rounded;

                if($fractional > 0.51) {
                    $assignedLeave = round($assignedLeave);
                }
                else {
                    $assignedLeave = $rounded;
                }

                $assignedLeave = max($assignedLeave, 0);

                // Create a new AssignLeave record for the user
                $assignLeave = new AssignLeave;
                $assignLeave->user_id = $user->id;
                $assignLeave->leave_id = $leave->id;
                $assignLeave->assign_leave = $assignedLeave;
                $assignLeave->leave_balance = $assignedLeave;
                $assignLeave->year = $now->year;

                if ($remainingMonths == 0) {
                    $assignLeave->year += 1;
                }

                $assignLeave->save();
            }
        }
    }

    public function check_duplication(Request $request)
    {
        if($request->ajax())
        {
            $userId = ($request->id)?$request->id:'';

            $check_dup = '';
            if($request->email)
            {
                $check_dup = User::where('email', $request->email)
                                    ->where(function ($query) use ($userId) {
                                        $query->where('id', '!=', $userId)
                                              ->orWhereNull('id');
                                    })
                                    ->first();
            }
            elseif($request->mobile_no)
            {
                $check_dup = User::where('mobile_no', $request->mobile_no)
                                    ->where(function ($query) use ($userId) {
                                        $query->where('id', '!=', $userId)
                                            ->orWhereNull('id');
                                    })
                                    ->first();
            }
            elseif($request->personal_email)
            {
                $check_dup = User::where('personal_email', $request->personal_email)
                                    ->where(function ($query) use ($userId) {
                                        $query->where('id', '!=', $userId)
                                            ->orWhereNull('id');
                                    })
                                    ->first();
            }

            if(isset($check_dup))
            {
                echo "false"; //already registered
                die;
            }
            else
            {
                echo "true";
                die;
            }
        }
    }

    public function leavehistory(Request $request) {

        $userData = User::where('status', 1)->where('id', $request->userId)->first();
        
        return view('user::leavehistory', compact('userData'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        if ($request->ajax()) {
            
            $data = User::select([
                'users.*',
                DB::raw("CONCAT(first_name, ' ', last_name) as full_name")
            ])->whereNot('id', 1)->latest();

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
                        return view('user::user_detail', compact('row'));
                    })
                    ->addColumn('status', function($row){
                        return view('user::status', compact('row'));
                    })
                    ->addColumn('action', function($row){
                        return view('user::action', compact('row'));
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNot('id', 1)->pluck('name','name')->all();
        $assignLeave = Leave::get();

        $designation = Designation::where('status', 1)->pluck('name', 'id');
        $department = Department::where('status', 1)->pluck('name', 'id');
        
        return view('user::create', compact('roles', 'assignLeave', 'designation', 'department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        
        $input = $request->all();

        // Yearly Deduction
        $input['gross_salary_A_yearly'] = $input['basic_yearly'] + $input['hra_yearly'] + $input['medical_yearly'] + $input['education_yearly'] + $input['conveyance_yearly'] + $input['special_allowance_yearly'];

        switch ($input['is_pf_deduct_yearly']) {
            case 'Yes':
                $input['employee_contribution_yearly'] = $input['basic_yearly'] * 12 / 100;
                break;
            case 'No':
                $input['employee_contribution_yearly'] = 0;
                break;
            case 'Fix':
                $input['employee_contribution_yearly'] = $input['employee_contribution_yearly'];
                break;
            default:
            $input['employee_contribution_yearly'] = 0;
                break;
        }

        $input['employee_contribution_B_yearly'] = $input['employee_contribution_yearly'] + $input['esi_employee_contribution_yearly'] + $input['labour_welfare_employee_yearly'] + $input['professional_tax_yearly'];
        $input['net_salary_C_yearly'] = $input['gross_salary_yearly'] - $input['employee_contribution_B_yearly'];

        $input['employer_contri_D_yearly'] = $input['employer_contribution_yearly'] + $input['esi_employer_contribution_yearly'] + $input['labour_welfare_employer_yearly'];

        $input['ctc_bcd_yearly'] = $input['employee_contribution_B_yearly'] + $input['net_salary_C_yearly'] + $input['employer_contri_D_yearly'];

        // Monthly Deduction
        $input['gross_salary_A_monthly'] = $input['basic_monthly'] + $input['hra_monthly'] + $input['medical_monthly'] + $input['education_monthly'] + $input['conveyance_monthly'] + $input['special_allowance_monthly'];

        switch ($input['is_pf_deduct_monthly']) {
            case 'Yes':
                $input['employee_contribution_monthly'] = $input['basic_monthly'] * 12 / 100;
                break;
            case 'No':
                $input['employee_contribution_monthly'] = 0;
                break;
            case 'Fix':
                $input['employee_contribution_monthly'] = $input['employee_contribution_monthly'];
                break;
            default:
            $input['employee_contribution_monthly'] = 0;
                break;
        }

        $input['employee_contribution_B_monthly'] = $input['employee_contribution_monthly'] + $input['esi_employee_contribution_monthly'] + $input['labour_welfare_employee_monthly'] + $input['professional_tax_monthly'];
        $input['net_salary_monthly'] = $input['gross_salary_monthly'] - $input['employee_contribution_B_monthly'];

        $input['employer_contri_D_monthly'] = $input['employer_contribution_monthly'] + $input['esi_employer_contribution_monthly'] + $input['labour_welfare_employer_monthly'];

        $input['ctc_bcd_monthly'] = $input['employee_contribution_B_monthly'] + $input['net_salary_monthly'] + $input['employer_contri_D_monthly'];

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->role);

        if($user) {

            $input['user_id'] = $user->id;
            $input['year'] = Carbon::now()->year;

            $userDetails = UserDetail::create($input);

            $salaryHistory = SalaryHistory::create($input);

            // $this->generateLetter($request->type_of_letter, $user->id);
        }

        return redirect()->route('user.index')->with('success', 'Employee added successfully!');
    }

    public function generateOfferLetter($typeOfLetter = null, $userId)
    {
        $userData = User::where('id', $userId)->first();

        $pdf = Pdf::loadView('user::offer_letter', compact('userData'));
        
        $content = $pdf->download()->getOriginalContent();
                
        $rootPath = storage_path('app/public').'/offer-letter';

        $client = Storage::createLocalDriver(['root' => $rootPath]);
        $pdf_name = $userData->emp_id.'-'.$userData->joining_date.'.pdf';

        $client->put($pdf_name, $content);

        return $pdf_name;
    }

    public function generateAppoitmentLetter($userId)
    {
        $userData = User::where('id', $userId)->first();

        $pdf = Pdf::loadView('user::appoitment_letter', compact('userData'));

        $content = $pdf->download()->getOriginalContent();
                
        $rootPath = storage_path('app/public').'/appoitment-letter';

        $client = Storage::createLocalDriver(['root' => $rootPath]);
        $pdf_name = $userData->emp_id.'-'.$userData->joining_date.'.pdf';

        $client->put($pdf_name, $content);

        return $pdf_name;
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::whereNot('id', 1)->pluck('name','name')->all();

        $selectedRole = $user->roles->first()->name ?? null;
             
        $designation = Designation::where('status', 1)->pluck('name', 'id');
        $department = Department::where('status', 1)->pluck('name', 'id');

        return view('user::edit', compact('user','roles', 'selectedRole', 'designation', 'department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        
        // Yearly Deduction
        $input['gross_salary_A_yearly'] = $input['basic_yearly'] + $input['hra_yearly'] + $input['medical_yearly'] + $input['education_yearly'] + $input['conveyance_yearly'] + $input['special_allowance_yearly'];

        switch ($input['is_pf_deduct_yearly']) {
            case 'Yes':
                $input['employee_contribution_yearly'] = $input['basic_yearly'] * 12 / 100;
                break;
            case 'No':
                $input['employee_contribution_yearly'] = 0;
                break;
            case 'Fix':
                $input['employee_contribution_yearly'] = $input['employee_contribution_yearly'];
                break;
            default:
            $input['employee_contribution_yearly'] = 0;
                break;
        }

        $input['employee_contribution_B_yearly'] = $input['employee_contribution_yearly'] + $input['esi_employee_contribution_yearly'] + $input['labour_welfare_employee_yearly'] + $input['professional_tax_yearly'];
        $input['net_salary_C_yearly'] = $input['gross_salary_yearly'] - $input['employee_contribution_B_yearly'];

        $input['employer_contri_D_yearly'] = $input['employer_contribution_yearly'] + $input['esi_employer_contribution_yearly'] + $input['labour_welfare_employer_yearly'];

        $input['ctc_bcd_yearly'] = $input['employee_contribution_B_yearly'] + $input['net_salary_C_yearly'] + $input['employer_contri_D_yearly'];

        // Monthly Deduction
        $input['gross_salary_A_monthly'] = $input['basic_monthly'] + $input['hra_monthly'] + $input['medical_monthly'] + $input['education_monthly'] + $input['conveyance_monthly'] + $input['special_allowance_monthly'];

        switch ($input['is_pf_deduct_monthly']) {
            case 'Yes':
                $input['employee_contribution_monthly'] = $input['basic_monthly'] * 12 / 100;
                break;
            case 'No':
                $input['employee_contribution_monthly'] = 0;
                break;
            case 'Fix':
                $input['employee_contribution_monthly'] = $input['employee_contribution_monthly'];
                break;
            default:
            $input['employee_contribution_monthly'] = 0;
                break;
        }

        $input['employee_contribution_B_monthly'] = $input['employee_contribution_monthly'] + $input['esi_employee_contribution_monthly'] + $input['labour_welfare_employee_monthly'] + $input['professional_tax_monthly'];
        $input['net_salary_monthly'] = $input['gross_salary_monthly'] - $input['employee_contribution_B_monthly'];

        $input['employer_contri_D_monthly'] = $input['employer_contribution_monthly'] + $input['esi_employer_contribution_monthly'] + $input['labour_welfare_employer_monthly'];

        $input['ctc_bcd_monthly'] = $input['employee_contribution_B_monthly'] + $input['net_salary_monthly'] + $input['employer_contri_D_monthly'];

        $userDetailColumns = \Schema::getColumnListing('user_details');

        $filteredInput = array_intersect_key($input, array_flip($userDetailColumns));
        
        if($user->update($input))
        {
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();

            $user->assignRole($request->input('role'));

            UserDetail::where('user_id', $user->id)->update($filteredInput);

            $filteredInput['year'] = Carbon::now()->year;
            $filteredInput['user_id'] = $user->id;

            SalaryHistory::updateOrCreate(
                ['user_id' => $filteredInput['user_id'], 'year' => $filteredInput['year'], 'job_type' => $input['job_type']],
                $filteredInput
            );

            /* if($request->assign_leave) {

                foreach($request->assign_leave as $key => $value) {

                    $assignLeave = new AssignLeave;

                    $assignLeave->user_id = $user->id;
                    $assignLeave->leave_id = $key;
                    $assignLeave->assign_leave = $value;
                    $assignLeave->leave_balance = $value;

                    $assignLeave->save();
                }
            } */

            return redirect()->route('user.index')->with('success', 'Employee Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $data_id = json_decode($request->data_id);

            if (User::whereIn('id',$data_id)->delete())
            {
                $status = true;
                $message = "Record successfully deleted";
            }
            else
            {
                $status = false;
                $message = "Opps Something went wrong";
            }
        }
        else
        {
            $status = false;
            $message = "Bad Request";
        }

        return response()->json(['status'=>$status,'message'=>$message]);
    }

    public function change_status(Request $request){

        if($request->ajax()){
            $id = $request->status_id;
            $status = $request->status;

            if(User::where('id',$id)->update(['status'=>$status])){
                $status = true;
                $message = "Status successfully updated";
            }
            else{
                $status = false;
                $message = "Opps Something went wrong";
            }
        }
        else{
            $status = false;
            $message = "Bad Request";
        }

        return response()->json(['status' => $status, 'message' => $message]);
    }
}
