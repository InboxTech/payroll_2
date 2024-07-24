<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HolidayLeave;
use Carbon\Carbon;

class HolidayLeaveList extends Component
{
    public $holidayLeaves;

    public function render() {
        
        $this->holidayLeaves = HolidayLeave::whereDate('holiday_date', '>=', Carbon::now())->get();

        return view('livewire.holiday-leave-list');
    }
}
