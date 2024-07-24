<?php

namespace Modules\Leave\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Leave;
use Modules\Leave\Http\Requests\CreateLeaveRequest;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('leave::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leave::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLeaveRequest $request) {

        if(Leave::create($request->all())){
            return redirect()->route('leave.index')->with('success', 'Leave Data Successfully Submitted');
        }

        return redirect()->route('leave.index')->with('error', 'Oops! Something went wrong');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('leave::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        $model = $leave;

        return view('leave::edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateLeaveRequest $request, Leave $leave) {
        
        if($leave->update($request->all())){
            return redirect()->route('leave.index')->with('success', 'Leave Data Successfully Updated');
        }

        return redirect()->route('leave.index')->with('error', 'Oops! Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        
        if(Leave::find($id)->delete()){
            return redirect()->route('leave.index')->with('error', 'Leave Data Successfully Deleted');
        }

        return redirect()->route('leave.index')->with('error', 'Oops! Something went wrong');
    }
}
