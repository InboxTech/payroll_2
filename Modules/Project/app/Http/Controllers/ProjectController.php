<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use DataTables;

class ProjectController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-project|create-project|edit-project|delete-project', ['only' => ['index','show']]);
        $this->middleware('permission:create-project', ['only' => ['create','store']]);
        $this->middleware('permission:edit-project', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-project', ['only' => ['destroy']]);
    }

    public function getEmployeeList(Request $request)
    {
        if($request->ajax()) {
            $userList = User::select('first_name', 'middle_name', 'last_name', 'id')
                    ->where('designation_id', $request->designation_id)->whereNot('id', 1)->get();

            $data = [];
            foreach($userList as $key => $value)
            {
                $fullName = trim($value->first_name . ' ' . $value->middle_name . ' ' . $value->last_name);
                $data[$value->id] = $fullName;
            }
            
            return response()->json($data);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function removedproject(Request $request)
    {
        if ($request->ajax()) {
            
            $data = Project::onlyTrashed()->latest();

            return Datatables::of($data)
                    ->filter(function ($query) use ($request) {
                        if ($request->has('project_name')) {
                            $query->where('project_name', 'like', "%" . $request->get('project_name') . "%");
                        }

                        if ($request->has('client_name')) {
                            $query->where('client_name', 'like', "%" . $request->get('client_name') . "%");
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        $btn = '<input type="checkbox" name="id[]" class="form-check-input jsCheckBoxes" value="'.$row->id.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){       
                        return view('project::action', compact('row'));
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }
        return view('project::removedproject');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $data = Project::latest();
            
            return Datatables::of($data)
                    ->filter(function ($query) use ($request) {
                        if ($request->project_name) {
                            $query->where('project_name', 'like', "%" . $request->get('project_name') . "%");
                        }

                        if ($request->client_name) {
                            $query->where('client_name', 'like', "%" . $request->get('client_name') . "%");
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        $btn = '<input type="checkbox" name="id[]" class="form-check-input jsCheckBoxes" value="'.$row->id.'">';
                        return $btn;
                    })
                    ->addColumn('action', function($row){       
                        return view('project::action', compact('row'));
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }
        return view('project::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $designationList = Designation::where('status', 1)->pluck('name', 'id');

        return view('project::create', compact('designationList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['project_team' => json_encode($request->project_team)]);

        if(Project::create($request->all())){
            return redirect()->route('project.index')->with('success', 'Project Submitted Successfully');
        }

        return redirect()->route('project.index')->with('error', 'Oops! Something went wrong');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('project::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $designationList = Designation::where('status', 1)->pluck('name', 'id');
        $employeeList = User::get();

        return view('project::edit', compact('project', 'designationList', 'employeeList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->merge(['project_team' => json_encode($request->project_team)]);

        if($project->update($request->all())){
            return redirect()->route('project.index')->with('success', 'Project Updated Successfully');
        }

        return redirect()->route('project.index')->with('error', 'Oops! Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            $data_id = json_decode($request->data_id);

            if (Project::whereIn('id',$data_id)->delete())
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

    public function restoreproject(Request $request)
    {
        if($request->ajax())
        {
            $data_id = json_decode($request->data_id);

            if (Project::whereIn('id',$data_id)->restore())
            {
                $status = true;
                $message = "Record successfully Restore";
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
