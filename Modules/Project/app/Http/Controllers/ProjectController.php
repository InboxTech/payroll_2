<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $data = Project::latest();

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
                    ->addColumn('checkbox', function($row){
                        $btn = '<input type="checkbox" name="id[]" class="form-check-input jsCheckBoxes" value="'.$row->id.'">';
                        return $btn;
                    })
                    ->addColumn('full_name', function($row){
                        return view('salary::user_detail', compact('row'));
                    })
                    ->addColumn('action', function($row){       
                        $btn = '<a href="'.route('salary.monthlist', $row->id).'" class="btn btn-sm btn-icon item-edit" title="Salary List"><i class="text-primary menu-icon tf-icons ti ti-file-dollar"></i></a>';
    
                        return $btn;
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
        return view('project::create');
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
        return view('project::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('project::edit');
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
