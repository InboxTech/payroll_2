<?php

namespace Modules\Designation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class DesignationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-designation|create-designation|edit-designation|delete-designation', ['only' => ['index','show']]);
        $this->middleware('permission:create-designation', ['only' => ['create','store']]);
        $this->middleware('permission:edit-designation', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-designation', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = Designation::get();
        
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){       
                        return view('designation::action', compact('row'));
                    })
                    ->addColumn('status', function($row){
                        return view('designation::status', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('designation::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('designation::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Designation::create($request->all())){
            return redirect()->route('designation.index')->with('success', 'Designation Submitted Successfully');
        }

        return redirect()->route('designation.index')->with('error', 'Oops! Something went wrong');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('designation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        return view('designation::edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
        if($designation->update($request->all())){
            return redirect()->route('designation.index')->with('success', 'Designation Updated Successfully');
        }

        return redirect()->route('designation.index')->with('error', 'Oops! Something went wrong');
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

            if(Designation::where('id',$id)->update(['status'=>$status])){
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
