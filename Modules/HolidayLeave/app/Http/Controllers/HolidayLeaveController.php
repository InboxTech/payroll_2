<?php

namespace Modules\HolidayLeave\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\HolidayLeave;
use Modules\HolidayLeave\Http\Requests\CreateHolidayLeaveRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HolidayLeaveController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-holiday-leave|create-holiday-leave|edit-holiday-leave|delete-holiday-leave', ['only' => ['index','show']]);
        $this->middleware('permission:create-holiday-leave', ['only' => ['create','store']]);
        $this->middleware('permission:edit-holiday-leave', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-holiday-leave', ['only' => ['destroy']]);
    }

    public function getnumberofholiday(Request $request)
    {
        $countofHoliday = HolidayLeave::where(DB::raw("(DATE_FORMAT(holiday_date,'%Y-%m'))"), $request->monthyear)->count();

        $data['countofHoliday'] = $countofHoliday;

        return response()->json(['data' => $data, 'status' => true]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('holidayleave::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('holidayleave::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->merge(['holiday_date' => Carbon::parse($request->holiday_date)->format('Y-m-d')]);

        if(HolidayLeave::create($request->all())) {
            return redirect()->route('leave.index')->with('sccess', 'Holiday Leave Data Successfully Submitted');
        }

        return redirect()->route('leave.index')->with('error', 'Something Went Wrong');
    }

    /**
     * Show the specified resource.
     */
    public function show($id) {
        return view('holidayleave::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HolidayLeave $holidayleave) {

        $model = $holidayleave;

        return view('holidayleave::edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HolidayLeave $holidayleave) {
        $request->merge(['holiday_date' => Carbon::parse($request->holiday_date)->format('Y-m-d')]);

        if($holidayleave->update($request->all())) {
            return redirect()->route('leave.index')->with('success', 'Holiday Leave updated successfully');
        }

        return redirect()->route('leave.index')->with('error', 'Something Went Wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {

        if(HolidayLeave::find($id)->delete()) {
            return redirect()->route('leave.index')->with('error', 'Holiday Leave deleted successfully');
        }

        return redirect()->route('leave.index')->with('error', 'Something Went Wrong');
    }
}
