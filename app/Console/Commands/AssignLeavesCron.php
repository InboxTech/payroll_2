<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Leave;
use App\Models\AssignLeave;
use Carbon\Carbon;

class AssignLeavesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assignleavescron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign Leaves to Employee';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $today = $now->format('Y-m-d');

        $users = User::where('status', 1)->where('confirmation_date', $today)->get();
        $leaveList = Leave::get();
        $totalLeaves = Leave::sum('number_of_leaves');
        $monthsInYear = 12;

        foreach ($users as $user) {
            $confirmationDate = Carbon::createFromDate($user->confirmation_date);
            $confirmationMonth = $confirmationDate->month;
            $remainingMonths = 12 - $confirmationMonth;

            $calculatedLeaves = ($totalLeaves / $monthsInYear) * $remainingMonths;

            foreach ($leaveList as $leave) {
                $assignedLeave = 0;

                switch ($leave->id) {
                    // Privilege Leave (PL)
                    case 1:
                        if ($remainingMonths > 2) {
                            $assignedLeave = ($calculatedLeaves * $leave->number_of_leaves) / $totalLeaves; // Distribute based on PL proportion

                            // check probation end in Jun to Dec
                            if($remainingMonths <= 7) {
                                $assignedLeave -= 1;
                            }
                        } else {
                            $assignedLeave = 0;
                        }

                        break;
                    // Sick Leave (SL)
                    case 2:

                    // Casual Leave (CL)
                    case 3:
                        // $assignedLeave = ($calculatedLeaves * $leave->number_of_leaves) / $totalLeaves;
                        $assignedLeave = $leave->number_of_leaves / $monthsInYear * $remainingMonths;

                        $assignedLeave = ceil($assignedLeave);

                        break;
                    default:
                        $assignedLeave = 0;
                        break;
                }

                if ($remainingMonths == 0) {
                    $assignedLeave = $leave->number_of_leaves;
                }

                $rounded = floor($assignedLeave);

                $fractional = $assignedLeave - $rounded;

                if($fractional > 0.51) {
                    $assignedLeave = round($assignedLeave);
                }
                else {
                    $assignedLeave = $rounded;
                }

                $assignedLeave = max($assignedLeave, 0);

                // Create a new AssignLeave record for the user
                $assignLeave = new AssignLeave;
                $assignLeave->user_id = $user->id;
                $assignLeave->leave_id = $leave->id;
                $assignLeave->assign_leave = $assignedLeave;
                $assignLeave->leave_balance = $assignedLeave;
                $assignLeave->year = $now->year;

                if ($remainingMonths == 0) {
                    $assignLeave->year += 1;
                }

                $assignLeave->save();
            }
        }
    }
}
