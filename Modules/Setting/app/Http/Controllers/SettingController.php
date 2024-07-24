<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting::index');
    }

    public function setting_submit(Request $request) {

        $result = Setting::where('master_key', '=', 'config')->get();

        if(!empty($request->config_company_logo)) {

            $get_company_logo = explode('storage/', $request->config_company_logo);
            $request->merge(['config_company_logo' => $get_company_logo[1]]);
        }
        else {

            $request->merge(['config_company_logo' => $request->edit_config_company_logo]);
        }
        
        if(!empty($request->config_fav_icon)) {

            $get_config_fav_icon = explode('storage/', $request->config_fav_icon);
            $request->merge(['config_fav_icon' => $get_config_fav_icon[1]]);
        } else {
            
            $request->merge(['config_fav_icon' => $request->edit_config_fav_icon]);
        }

        if(($request->all()) != 'null' && !empty($request->all()))
        {
            foreach($request->all() as $key => $value)
            {
                if($key != '_token')
                {
                    if(!empty($result))
                    {
                        foreach($result as $k => $val)
                        {
                            if($val['config_key'] == $key)
                            {
                                Setting::where('id', $val['id'])->update(['config_value' => $value]);
                            }
                        }
                    }
                }
            }
        }
        return redirect()->route('setting.index')->with('success', 'Data Successfully Submitted');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting::create');
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
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('setting::edit');
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
