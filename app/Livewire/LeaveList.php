<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Leave;

class LeaveList extends Component
{
    public $leave_list;

    public function render()
    {
        $this->leave_list = Leave::get();

        return view('livewire.leave-list');
    }
}
