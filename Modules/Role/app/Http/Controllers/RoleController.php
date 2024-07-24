<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $data = Role::select('*')->whereNot('id', 1);
        
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        $btn = '<input type="checkbox" name="id[]" value="'.$row->id.'" class="form-check-input">';
                        return $btn;
                    })
                    ->addColumn('permission_count', function($row){
                        $count = $row->permissions->count();
                        return $count;
                    })
                    ->addColumn('action', function($row){
       
                        $btn = '<a href="'.route('role.edit', $row->id).'" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action', 'checkbox'])
                    ->make(true);
        }
        return view('role::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::select('group_name', 'name', 'id')->get()->groupBy('group_name');
        
        return view('role::create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->input('name')]);

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')->with('success','Role Created Successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('role::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $model = $role;
        $permissions = Permission::select('group_name', 'name', 'id')->get()->groupBy('group_name');

        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return view('role::edit', compact('model', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if($role->update($request->all()))
        {
            $role->syncPermissions($request->input('permission'));

            return redirect()->route('role.index')->with('success','Role Updated Successfully');
        }
        
        return redirect()->route('role.index')->with('error','Something went wrong');        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax())
        {
            Role::whereIn('id', $request->ids)->delete();

            session()->flash('success', 'Roles Deleted Successfully.');

            return response()->json(['success' => true, 'message' => 'Role deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Something went wrong']);
    }
}
