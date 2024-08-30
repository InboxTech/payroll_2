    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('user.index') }}" class="text-reset">Employee</a> / Leave History
                    </span> / {{ $userData->full_name }}
                </h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-danger"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    @php 
                        use Carbon\Carbon;

                        $now = Carbon::now();
                        
                        $joiningDate = Carbon::parse($userData->joining_date);
                        $printedYears = [];
                        $no = 0;
                        
                        // Get all years between joining date and now, and sort them in descending order
                        $years = [];
                        for ($date = $joiningDate; $date->lte($now); $date->addYear()) {
                            $years[] = $date->year;
                        }
                        $years = array_reverse($years); // Reverse the array to have the most recent year first
                    @endphp

                    <div class="accordion mt-3" id="accordionExample">
                        @foreach ($years as $year)
                            @if (!in_array($year, $printedYears))
                                <div class="card accordion-item @if($no == 0) active @endif">
                                    <h2 class="accordion-header" id="heading{{ $no }}">
                                        <button type="button" class="accordion-button @if($no != 0) collapsed @endif" data-bs-toggle="collapse" data-bs-target="#accordion{{ $no }}" aria-expanded="@if($no == 0) true @else false @endif" aria-controls="accordion{{ $no }}">
                                            Year : {{ $year }}
                                        </button>
                                    </h2>
                                    <div id="accordion{{ $no }}" class="accordion-collapse collapse @if($no == 0) show @endif" aria-labelledby="heading{{ $no }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row g-3">
                                                <h5>Assign Leaves On This Year</h5>
                                                <table class="table table-borderless border-top">
                                                    <thead class="border-bottom">
                                                        <tr>
                                                            @foreach($userData->assign_leave->where('year', $year) as $alkey => $alvalue)
                                                                <th>{{ $alvalue->leave->leave_type_name }}</th>
                                                            @endforeach
                                                            <th>Total Leaves</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @php
                                                                $assignLeave = 0;
                                                                $leaveBalance = 0;
                                                            @endphp
                                                            @foreach($userData->assign_leave->where('year', $year) as $alkey => $alvalue)
                                                                <td>
                                                                    <p><strong>Assign Leave :</strong> {{ $alvalue->assign_leave }}</p>
                                                                    <p><strong>Leave Balance:</strong> {{ $alvalue->leave_balance }}</p>
                                                                    @php
                                                                        $assignLeave += $alvalue->assign_leave;
                                                                        $leaveBalance += $alvalue->leave_balance;
                                                                    @endphp
                                                                </td>
                                                            @endforeach
                                                            <td>
                                                                <p>{{ $assignLeave }}</p>
                                                                <p>{{ $leaveBalance }}</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
                                                <h5>Taken Leaves</h5>
                                                <table class="table table-borderless border-top">
                                                    <thead class="border-bottom">
                                                        <tr>
                                                            <th>Leave Type Name</th>
                                                            <th>From Date - To Date</th>
                                                            <th>Total Leave Day</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($userData->leave_apply->filter(function($leave) use ($year) {
                                                            return Carbon::parse($leave->from_date)->year == $year && $leave->is_approved == 1;
                                                        }) as $key => $value)
                                                            <tr>
                                                                <td>{{ $value->leave->leave_type_name }}</td>
                                                                <td>{{ Carbon::parse($value->from_date)->format('d-m-Y') }} To {{ Carbon::parse($value->to_date)->format('d-m-Y') }}</td>
                                                                <td>{{ $value->number_of_days }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center">No Leaves Taken</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $no++;
                                    $printedYears[] = $year;  // Add the printed year to the array to prevent duplicate prints
                                @endphp
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    @endsection
