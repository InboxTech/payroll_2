<?php

namespace Modules\AppliedLeave\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveApply;
use App\Models\Leave;
use App\Models\User;
use App\Models\AssignLeave;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppliedLeaveController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-applied-leave|create-applied-leave|edit-applied-leave|delete-applied-leave', ['only' => ['index','show']]);
        $this->middleware('permission:create-applied-leave', ['only' => ['create','store']]);
        $this->middleware('permission:edit-applied-leave', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-applied-leave', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = LeaveApply::where('is_leave_cancle', 1)->latest();

            return Datatables::of($data)
                    ->filter(function ($query) use ($request) {
                        if ($request->has('user_id') && $request->user_id) {
                            $query->where('user_id', $request->user_id);
                        }

                        if ($request->has('from_date') && $request->from_date && $request->has('to_date') && $request->to_date) {
                            $query->whereDate('from_date', '>=', $request->from_date)
                                  ->whereDate('to_date', '<=', $request->to_date);
                        } elseif ($request->has('from_date') && $request->from_date) {
                            $query->whereDate('from_date', '>=', $request->from_date);
                        } elseif ($request->has('to_date') && $request->to_date) {
                            $query->whereDate('to_date', '<=', $request->to_date);
                        }

                        if ($request->has('is_approved') && $request->is_approved) {
                            $query->where('is_approved', $request->is_approved);
                        }
                    })
                    ->addColumn('checkbox', function($row) {
                        $btn = '<input type="checkbox" name="id[]" class="form-check-input jsCheckBoxes" value="'.$row->id.'">';
                        return $btn;
                    })
                    ->addColumn('employee_name', function($row) {
                        return view('appliedleave::user_details', compact('row'));
                    })
                    ->addColumn('leave_type_name', function($row) {
                        return $row->leave->leave_type_name;
                    })
                    ->addColumn('from_date_to_date', function($row) {
                        return date('d-m-Y', strtotime($row->from_date)).' To '.date('d-m-Y', strtotime($row->to_date));
                    })
                    ->addColumn('approval_status', function($row) {
                        return view('appliedleave::approved_status', compact('row'));
                    })
                    ->addColumn('action', function($row) {
                        return view('appliedleave::action', compact('row'));
                    })
                    ->addColumn('apply_date', function($row) {
                        return date('d-m-Y', strtotime($row->created_at));
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }

        $userList = User::where('id', '!=', 1)->where('status', 1)->pluck(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), 'id');

        return view('appliedleave::index', compact('userList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appliedleave::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('appliedleave::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = LeaveApply::findorFail($id);
        $leavetype = Leave::pluck('leave_type_name', 'id');

        return view('appliedleave::edit', compact('model', 'leavetype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leaveApply = LeaveApply::findorFail($id);
        
        if($leaveApply) {
            $assignLeave = AssignLeave::where(['user_id' => $leaveApply->user_id, 'leave_id' => $leaveApply->leave_id])->first();
            
            if($assignLeave) {
                switch($request->is_approved) {
                    case '0':
                    case '2':
                        break;
                    case '1':
                        $newLeaveBalance = $assignLeave->leave_balance - $leaveApply->number_of_days;

                        if ($newLeaveBalance < 0) {
                            return redirect()->route('appliedleave.edit', $leaveApply->id)->with('error', 'Insufficient Leave Balance');
                        }

                        $assignLeave->leave_balance = $newLeaveBalance; 
                        $assignLeave->save();

                        break;
                    default:
                        return redirect()->route('appliedleave.index')->with('error', 'Invalid leave status');
                }
            }
            else  {
                return redirect()->route('appliedleave.index')->with('error', 'Leave Not Assign');
            }

            $leaveApply->is_approved = $request->is_approved;
            $leaveApply->save();

            return redirect()->route('appliedleave.index')->with('success', 'Leave Status Updated Successfully');
        }

        return redirect()->route('appliedleave.index')->with('error', 'Leave application not found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $data_id = json_decode($request->data_id);

            LeaveApply::whereIn('id',$data_id)->update(['deleted_by' => Auth::user()->id]);

            if (LeaveApply::whereIn('id',$data_id)->delete())
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

    public function getNumberofLeavesinThisMonth(Request $request)
    {
        $monthYear = $request->input('monthYear');
        $userId = $request->input('userId');

        $userData = User::where('id', $userId)->with('user_detail')->first();

        $year = substr($monthYear, 0, 4);
        $month = substr($monthYear, 5, 2);

        $date = Carbon::createFromDate($year, $month, 1);

        $numberOfDays = $date->daysInMonth;
        
        $numberOfLeave = LeaveApply::whereYear('from_date', $year)->whereMonth('from_date', $month)->where('user_id', $userId)->sum('number_of_days');

        $perDaySalary = $userData->user_detail->gross_salary_A_monthly / $numberOfDays;
        $data['numberOfLeave'] = $numberOfLeave;
        $data['numberOfDaysWork'] = $numberOfDays - $numberOfLeave;

        $data['perDaySalary'] = number_format(round($perDaySalary), 2, '.', ',');

        return response()->json(['data' => $data, 'status' => true]);
    }

    public function editleave($id)
    {
        $result = LeaveApply::findorFail($id);
        $leavetype = Leave::pluck('leave_type_name', 'id');

        return view('appliedleave::editleave', compact('result', 'leavetype'));
    }

    public function updateleave(Request $request, LeaveApply $leaveapply)
    {
        $fromDate = Carbon::parse($request->input('from_date'));
        $toDate = Carbon::parse($request->input('to_date'));

        $newLeaveCount = $toDate->diffInDays($fromDate) + 1;

        $originalLeaveCount = $leaveapply->number_of_days;
        $leaveDifference = $originalLeaveCount - $newLeaveCount;
        
        switch ($request->input('leave_mode')) {
            case '2': 
            case '3': 
                $newLeaveCount -= 0.5;
                break;
            default:
                break;
        }
        
        $request->merge(['number_of_days' => $newLeaveCount]);

        if($leaveapply->update($request->all())) {

            $assignLeave = AssignLeave::where(['user_id' => $leaveapply->user_id, 'leave_id' => $leaveapply->leave_id])->first();

            if($assignLeave) {

                // 2 for leave cancle
                if($request->is_leave_cancle == 2)
                {
                    $assignLeave->leave_balance += $originalLeaveCount;
                    $assignLeave->save();

                    $leaveapply->delete();

                    return redirect()->route('appliedleave.index')->with('success', 'Leave has been cancelled.');
                }
                else
                {
                    switch($leaveapply->is_approved) {
                        case '0':
                        case '2':
                            break;
                        case '1':
                            $assignLeave->leave_balance += $leaveDifference;
                            $assignLeave->save();

                            break;
                        default:
                            return redirect()->route('appliedleave.index')->with('error', 'Invalid leave status');
                    }

                    return redirect()->route('appliedleave.index')->with('success', 'Your Leave Successfully Updated');
                }                
            }
        }

        return redirect()->route('appliedleave.edit', $leaveapply->id)->with('error', 'Something Went Wrong. Please Try Again!');
    }
}
