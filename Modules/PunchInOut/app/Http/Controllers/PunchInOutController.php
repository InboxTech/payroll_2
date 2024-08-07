<?php

namespace Modules\PunchInOut\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\PunchInOut;
use DataTables;

class PunchInOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {

        if($request->ajax()) {

            $data = PunchInOut::where('user_id', Auth::user()->id);

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
                $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

                $data->whereBetween('date', [$startDate, $endDate]);
                
            }elseif ($request->filled('start_date')) {
                $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
                $data->whereDate('date', $startDate);
            }

            $data = $data->orderBy('date', 'DESC')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row) {
                        return $row->user->full_name;
                    })
                    ->addColumn('date', function($row) {
                        return date('d-m-Y', strtotime($row->date));
                    })
                    ->addColumn('punch_in', function($row) {
                        return view('punchinout::punch_in', compact('row'));
                    })
                    ->addColumn('punch_out', function($row){
                        return view('punchinout::punch_out', compact('row'));
                    })
                    ->addColumn('total_time', function($row) {
                        if($row->punch_out != null) {
                            $punchIn = new Carbon($row->punch_in);
                            $punchOut = new Carbon($row->punch_out);

                            return $timeDifference = $punchIn->diff($punchOut)->format('%H:%I'). ' Hr';
                        }
                        return '00:00'.' Hr';
                    })
                    ->addColumn('action', function($row){       
                        $btn = '<a href="'.route('punchinout.edit', $row->id).'" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>';
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $punchRecord = PunchInOut::where(['date' => Carbon::now()->toDateString(), 'user_id' => Auth::user()->id])->latest()->first();

        return view('punchinout::index', compact('punchRecord'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('punchinout::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $punchInOut = new PunchInOut();

        $punchInOut->user_id = Auth::user()->id;
        $punchInOut->date = Carbon::now()->toDateString();
        $punchInOut->punch_in = date('H:i');
        $punchInOut->punch_in_lat = $request->latitude;
        $punchInOut->punch_in_long = $request->longitude;
        $punchInOut->punch_in_out_status = 1;
        $punchInOut->save();

        return redirect()->route('punchinout.index')->with('success', 'You have Successfully Punch In');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('punchinout::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PunchInOut $punchinout)
    {
        return view('punchinout::edit', compact('punchinout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $punchInOut = PunchInOut::findorFail($id);

        $punchInOut->punch_out_lat = $request->latitude;
        $punchInOut->punch_out_long = $request->longitude;
        $punchInOut->punch_in_out_status = 0;
        
        if($request)
        {
            $punchInOut->punch_out = $request->punch_out;
            $punchInOut->save();

            return redirect()->route('punchinout.index')->with('success', 'Attendence Update Successfully');
        } else {
            $punchInOut->punch_out = date('H:i');
            $punchInOut->save();

            return redirect()->route('punchinout.index')->with('success', 'You have Successfully Punch Out');
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
