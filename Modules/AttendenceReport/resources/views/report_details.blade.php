    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>Punch In Time</th>
                <th>Punch Out Time</th>
                <th>Total Hours</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @php
                use Carbon\Carbon;

                $startDate = Carbon::createFromDate($request->monthYear)->startOfMonth();
                $endDate = Carbon::createFromDate($request->monthYear)->endOfMonth();
                $dataFound = false;

                // Create an array of holiday dates for easy lookup
                $holidayMap = $holidayleave->pluck('holiday_name', 'holiday_date')->toArray();

                $currentMonthYear = Carbon::now()->format('Y-m');

                if ($request->monthYear == $currentMonthYear) {
                    $endDate = Carbon::now();
                }
            @endphp

            @for($date = $startDate; $date->lte($endDate); $date->addDay())
                @php
                    $dayData = $data->firstWhere('date', $date->format('Y-m-d'));
                    $holidayName = $holidayMap[$date->format('Y-m-d')] ?? null;
                @endphp
                <tr>
                    <td>{{ $date->format('d-m-Y') }}</td>
                    <td>
                        @if($holidayName)
                            Holiday - {{ $holidayName }}
                        @elseif($dayData)
                            @php $dataFound = true; @endphp
                            Present
                        @elseif($date->isWeekend())
                            Week Off
                        @else
                            Absent
                        @endif
                    </td>
                    <td>
                        @if($dayData && (!$date->isWeekend() || ($date->isSaturday() && $dayData->punch_in)) && !$holidayName)
                            {{ date('h:i A', strtotime($dayData->punch_in)) }} 
                            &nbsp;<a href="https://www.google.com/maps?q={{ $dayData->punch_in_lat }},{{ $dayData->punch_in_long }}" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                        @else
                            00:00
                        @endif
                    </td>
                    <td>
                        @if($dayData && $dayData->punch_out !== null && !$date->isWeekend() && !$holidayName)
                            {{ date('h:i A', strtotime($dayData->punch_out)) }}
                            &nbsp;<a href="https://www.google.com/maps?q={{ $dayData->punch_out_lat }},{{ $dayData->punch_out_long }}" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                        @else
                            00:00
                        @endif
                    </td>
                    <td>
                        @if($dayData && $dayData->punch_out !== null && !$date->isWeekend() && !$holidayName)
                            @php
                                $punchIn = new Carbon($dayData->punch_in);
                                $punchOut = new Carbon($dayData->punch_out);

                                $timeDifference = $punchOut->diff($punchIn)->format('%H:%I');
                                echo $timeDifference . ' Hr';
                            @endphp
                        @else
                            00:00
                        @endif
                    </td>
                </tr>
            @endfor

            @if (!$dataFound)
                <tr>
                    <td colspan="5" class="text-center">No Data Found</td>
                </tr>
            @endif
        </tbody>
    </table>