<?php

namespace Modules\AttendanceCorrection\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\PunchInOut;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;

class AttendanceCorrectionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-list-attendance-correction', ['only' => ['index']]);
        $this->middleware('permission:attendance-list-attendancecorrection', ['only' => ['correction', 'attendancelist']]);
        $this->middleware('permission:edit-attendance-correction', ['only' => ['edit','update']]);
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
                    ->addColumn('correction', function($row) {
                        return view('attendancecorrection::action', compact('row'));
                    })
                    ->rawColumns(['correction', 'full_name'])
                    ->make(true);
        }

        return view('attendancecorrection::index');
    }

    public function correction(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return view('attendancecorrection::correction', compact('user'));
    }

    public function attendancelist(Request $request)
    {
        $startDate = Carbon::createFromDate($request->monthYear)->startOfMonth();
        $endDate = Carbon::createFromDate($request->monthYear)->endOfMonth();

        $data = PunchInOut::whereBetween('date', [$startDate, $endDate])->where('user_id', $request->user_id)->orderBy('date', 'ASC')->get();

        return view('attendancecorrection::attendancelist', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendancecorrection::create');
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
        return view('attendancecorrection::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $punchinout = PunchInOut::where('id', $id)->first();

        return view('attendancecorrection::edit', compact('punchinout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $punchInOut = PunchInOut::findorFail($id);

        if($request->punch_out) {
            $punchInOut->punch_out_lat = $request->latitude;
            $punchInOut->punch_out_long = $request->longitude;
            $punchInOut->punch_in_out_status = 0;
            $punchInOut->punch_out = $request->punch_out;
            $punchInOut->save();

            return redirect()->route('attendancecorrection.index')->with('success', 'Attendance Update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
