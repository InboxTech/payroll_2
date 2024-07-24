<?php

namespace Modules\LeaveApply\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Leave;
use App\Models\LeaveApply;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DataTables;

class LeaveApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            
            $data = LeaveApply::where('user_id', Auth::user()->id)->get();

            return Datatables::of($data)
                    ->addColumn('checkbox', function($row) {
                        $btn = '<input type="checkbox" name="id[]" class="form-check-input jsCheckBoxes" value="'.$row->id.'">';
                        return $btn;
                    })
                    ->addColumn('leave_type_name', function($row) {
                        return $row->leave->leave_type_name;
                    })
                    ->addColumn('from_date_to_date', function($row) {
                        return date('d-m-Y', strtotime($row->from_date)).' To '.date('d-m-Y', strtotime($row->to_date));
                    })
                    ->addColumn('approval_status', function($row) {
                        return view('leaveapply::approved_status', compact('row'));
                    })
                    ->addColumn('action', function($row) {
                            
                        if($row->is_approved == 1 || $row->is_approved == 2) {
                            $btn = '';
                        } else {
                            $btn = '<a href="'.route('leaveapply.edit', $row->id).'" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>';
                        }

                        return $btn;
                    })
                    ->addColumn('apply_date', function($row) {
                        return date('d-m-Y', strtotime($row->created_at));
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }

        return view('leaveapply::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leavetype = Leave::pluck('leave_type_name', 'id');

        return view('leaveapply::create', compact('leavetype'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fromDate = Carbon::parse($request->input('from_date'));
        $toDate = Carbon::parse($request->input('to_date'));
        
        $leaveCount = $toDate->diffInDays($fromDate) + 1;

        switch ($request->input('leave_mode')) {
            case '2':
            case '3':
                $leaveCount -= 0.5;
                break;
            default:
                break;
        }

        $request->merge(['user_id' => Auth::user()->id, 'number_of_days' => $leaveCount]);

        if(LeaveApply::create($request->all())) {
            return redirect()->route('leaveapply.index')->with('success', 'Your Leave successfully applied');
        }

        return redirect()->route('leaveapply.index')->with('error', 'Something went wrong');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('leaveapply::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveApply $leaveapply)
    {
        $model = $leaveapply;

        $leavetype = Leave::pluck('leave_type_name', 'id');
        
        return view('leaveapply::edit', compact('model', 'leavetype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveApply $leaveapply)
    {
        $fromDate = Carbon::parse($request->input('from_date'));
        $toDate = Carbon::parse($request->input('to_date'));

        $leaveCount = $toDate->diffInDays($fromDate) + 1;
        
        switch ($request->input('leave_mode')) {
            case '2': 
            case '3': 
                $leaveCount -= 0.5;
                break;
            default:
                break;
        }
        
        $request->merge(['user_id' => Auth::user()->id, 'number_of_days' => $leaveCount]);

        if($leaveapply->update($request->all())) {
            return redirect()->route('leaveapply.index')->with('success', 'Your Leave Successfully Updated');
        }

        return redirect()->route('leaveapply.edit', $leaveapply->id)->with('error', 'Something Went Wrong. Please Try Again!');
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
