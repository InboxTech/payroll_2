<?php

namespace Modules\Department\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Department;
use DataTables;

class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-department|create-department|edit-department|delete-department', ['only' => ['index','show']]);
        $this->middleware('permission:create-department', ['only' => ['create','store']]);
        $this->middleware('permission:edit-department', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-department', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = Department::latest();
        
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){       
                        return view('department::action', compact('row'));
                    })
                    ->addColumn('status', function($row){
                        return view('department::status', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('department::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Department::create($request->all())){
            return redirect()->route('department.index')->with('success', 'Department Submitted Successfully');
        }

        return redirect()->route('department.index')->with('error', 'Oops! Something went wrong');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('department::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('department::edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        if($department->update($request->all())){
            return redirect()->route('department.index')->with('success', 'Department Updated Successfully');
        }

        return redirect()->route('department.index')->with('error', 'Oops! Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function change_status(Request $request){

        if($request->ajax()){
            $id = $request->status_id;
            $status = $request->status;

            if(Department::where('id',$id)->update(['status'=>$status])){
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
