<?php

namespace Modules\ProjectManager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Models\User;
use App\Models\LeaveApply;
use App\Models\Leave;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectManagerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-leave-pm|edit-leave-pm', ['only' => ['index','show']]);
        $this->middleware('permission:edit-leave-pm', ['only' => ['edit','update']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = [];
            
            if(Auth::user()->hasRole('Admin')) {
                $data = LeaveApply::with('user')->get();
            }
            else {
            
                $user = User::where('project_manager_id', Auth::user()->id)->with('leave_apply')->get();
            
                if($user) {
                    foreach($user as $ukey => $uvalue) 
                    {
                        foreach($uvalue['leave_apply'] as $key => $value)
                        {
                            $data[] = $value;
                        }
                    }
                }
                
                $data = array_reverse($data);
            }

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

                        if ($request->is_approved) {
                            $query->where('is_approved', $request->is_approved);
                        }
                    })
                    ->addColumn('employee_name', function($row) {
                        return view('projectmanager::user_details', compact('row'));
                    })
                    ->addColumn('leave_type_name', function($row) {
                        return $row->leave->leave_type_name;
                    })
                    ->addColumn('from_date_to_date', function($row) {
                        return date('d-m-Y', strtotime($row->from_date)).' To '.date('d-m-Y', strtotime($row->to_date));
                    })
                    ->addColumn('approval_status', function($row) {
                        return view('projectmanager::approved_status', compact('row'));
                    })
                    ->addColumn('is_leave_cancle', function($row) {
                        if($row->is_leave_cancle == 2) {
                            return 'Yes';
                        }
                        return '';
                    })
                    ->addColumn('apply_date', function($row) {
                        return date('d-m-Y', strtotime($row->created_at));
                    })
                    ->addColumn('action', function($row) {
                        return view('projectmanager::action', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        $userList = User::where('id', '!=', 1)->where('status', 1)->pluck(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), 'id');

        return view('projectmanager::index', compact('userList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projectmanager::create');
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
        return view('projectmanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leaveapply = LeaveApply::where('id', $id)->firstOrFail();

        return view('projectmanager::edit', compact('leaveapply'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leaveapply = LeaveApply::findorFail($id);

        if($leaveapply->update($request->all())) {
            
            return redirect()->route('projectmanager.index')->with('success', 'Leave Status Successfully Updated');
        }

        return redirect()->route('projectmanager.edit', $leaveapply->id)->with('error', 'Something Went Wrong. Please Try Again!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
