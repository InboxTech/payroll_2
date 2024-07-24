<?php

namespace Modules\AppliedLeave\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveApply;
use App\Models\Leave;
use App\Models\AssignLeave;
use DataTables;

class AppliedLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = LeaveApply::where('is_leave_cancle', 1)->get();

            return Datatables::of($data)
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
                            
                        $btn = '<a href="'.route('appliedleave.edit', $row->id).'" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil" title="Edit"></i></a>';
                        
                        return $btn;
                    })
                    ->addColumn('apply_date', function($row) {
                        return date('d-m-Y', strtotime($row->created_at));
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }

        return view('appliedleave::index');
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
                        $newLeaveBalance = $assignLeave->number_of_leaves - $leaveApply->number_of_days;

                        if ($newLeaveBalance < 0) {
                            return redirect()->route('appliedleave.edit', $leaveApply->id)->with('error', 'Insufficient Leave Balance');
                        }

                        $assignLeave->number_of_leaves = $newLeaveBalance; 
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
}
