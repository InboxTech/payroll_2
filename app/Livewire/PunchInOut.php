<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PunchInOut extends Component
{
    public $punchRecord;
    public $latitude;
    public $longitude;

    protected $listeners = ['locationReceived'];

    public function mount()
    {
        $this->punchRecord = \App\Models\PunchInOut::where(['date' => Carbon::now()->toDateString(), 'user_id' => Auth::user()->id])->latest()->first();
        
        if(!empty($this->punchRecord) && $this->punchRecord->punch_out != null) {

            $punchIn = Carbon::createFromTimestamp($this->punchRecord->punch_in);
            $punchOut = Carbon::createFromTimestamp($this->punchRecord->punch_out);

            $timeDifference = $punchOut->diff($punchIn)->format('%H:%I');
            $this->punchRecord['total_time'] = $timeDifference;
        }
    }

    public function punchIn()
    {
        $this->storePunchInOut($this->latitude, $this->longitude, 1);

        return redirect()->route('punchinout.index')->with('success', 'You have Successfully Punch In');
    }

    public function punchOut()
    {
        $this->storePunchInOut($this->latitude, $this->longitude, 0);

        return redirect()->route('punchinout.index')->with('success', 'You have Successfully Punch Out');
    }

    public function storePunchInOut($latitude, $longitude, $status) {

        \App\Models\PunchInOut::updateOrCreate([
            'user_id' => Auth::user()->id,
            'date' => Carbon::now()->toDateString(),
            'punch_in' => Carbon::now()->timestamp,
            
        ]);
    }

    public function locationReceived($location)
    {
        $this->latitude = $location['latitude'];
        $this->longitude = $location['longitude'];
    }

    public function render()
    {
        return view('livewire.punch-in-out');
    }
}
