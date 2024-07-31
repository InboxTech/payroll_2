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
use App\Models\UserDetail;
use App\Models\AssignLeave;
use App\Models\Leave;
use DataTables;
use Modules\User\Http\Requests\CreateUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
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
                                              ->orWhereNull('id'); // Handles cases where id is null (new record)
                                    })
                                    ->first();
            }
            elseif($request->mobile_no)
            {
                $check_dup = User::where('mobile_no', $request->mobile_no)
                                    ->where(function ($query) use ($userId) {
                                        $query->where('id', '!=', $userId)
                                            ->orWhereNull('id'); // Handles cases where id is null (new record)
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
                        return view('user::user_detail', compact('row'));
                    })
                    ->addColumn('status', function($row){
                        return view('user::status', compact('row'));
                    })
                    ->addColumn('action', function($row){       
                        $btn = '<a href="'.route('user.edit', $row->id).'" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>';
    
                        return $btn;
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
        
        return view('user::create', compact('roles', 'assignLeave'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // Yearly Deduction
        $input['gross_salary_A_yearly'] = $input['basic_yearly'] + $input['hra_yearly'] + $input['medical_yearly'] + $input['education_yearly'] + $input['conveyance_yearly'] + $input['special_allowance_yearly'];

        switch ($input['is_pf_deduct_yearly']) {
            case 'Yes':
                $input['employee_contribution_yearly'] = $input['basic_yearly'] * 12 / 100;
                break;
            case 'No':
                $input['employee_contribution_yearly'] = '';
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
                $input['employee_contribution_monthly'] = '';
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

            $request->merge(['user_id' => $user->id]);

            $userDetails = UserDetail::create($request->all());

            if($request->assign_leave) {

                foreach($request->assign_leave as $key => $value) {

                    $assignLeave = new AssignLeave;

                    $assignLeave->user_id = $user->id;
                    $assignLeave->leave_id = $key;
                    $assignLeave->number_of_leaves = $value;

                    $assignLeave->save();
                }
            }
        }

        return redirect()->route('user.index')->with('success', 'User added successfully!');
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
        $assignLeave = Leave::get();

        return view('user::edit', compact('user','roles', 'selectedRole', 'assignLeave'));
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
                $input['employee_contribution_yearly'] = '';
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
                $input['employee_contribution_monthly'] = '';
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

            return redirect()->route('user.index')->with('success', 'User Updated Successfully!');
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
