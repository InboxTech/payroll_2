<?php

namespace Modules\HolidayLeave\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\HolidayLeave;
use Modules\HolidayLeave\Http\Requests\CreateHolidayLeaveRequest;
use Illuminate\Support\Facades\DB;

class HolidayLeaveController extends Controller
{
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
    public function store(CreateHolidayLeaveRequest $request) {

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
    public function update(CreateHolidayLeaveRequest $request, HolidayLeave $holidayleave) {

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
