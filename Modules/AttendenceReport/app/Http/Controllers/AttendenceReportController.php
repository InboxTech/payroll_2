<?php

namespace Modules\AttendenceReport\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\PunchInOut;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Carbon;

class AttendenceReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-list', ['only' => ['index','show']]);
        $this->middleware('permission:view-attendance-report', ['only' => ['report']]);
        
        /* $this->middleware('permission:view-attendance-report|create-attendance-report|edit-attendance-report|delete-attendance-report', ['only' => ['index','show']]);
        $this->middleware('permission:create-attendance-report', ['only' => ['create','store']]);
        $this->middleware('permission:edit-attendance-report', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-attendance-report', ['only' => ['destroy']]); */
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {

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
                    ->addColumn('full_name', function($row) {
                        return $row->full_name;
                    })
                    ->addColumn('report', function($row) {
                        return view('attendencereport::action', compact('row'));
                    })
                    ->rawColumns(['report', 'full_name'])
                    ->make(true);
        }

        return view('attendencereport::index');
    }

    public function report(Request $request, $id)
    {
        $user = User::findorFail($id);
        
        return view('attendencereport::report', compact('user'));
    }

    public function report_details(Request $request)
    {
        $startDate = Carbon::createFromDate($request->monthYear)->startOfMonth();
        $endDate = Carbon::createFromDate($request->monthYear)->endOfMonth();
        
        $data = PunchInOut::whereBetween('date', [$startDate, $endDate])->where('user_id', $request->user_id)->orderBy('date', 'ASC')->get();
        
        return view('attendencereport::report_details', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendencereport::create');
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
        return view('attendencereport::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('attendencereport::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
