<table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Present / Absent</th>
            <th>Punch In Time</th>
            <th>Punch Out Time</th>
            <th>Total Hours</th>
            @can('edit-attendance-correction')
                <th>Action</th>
            @endcan
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @forelse($data as $dkey => $dvalue)
            <tr>
                <td>{{ \Carbon\Carbon::parse($dvalue->date)->format('d-m-Y') }}</td>
                <td>@if($dvalue) Present @else Absent @endif</td>
                <td>{{ date('h:i A', strtotime($dvalue->punch_in)) }} &nbsp;<a href="https://www.google.com/maps?q={{ $dvalue->punch_in_lat }},{{ $dvalue->punch_in_long }}" target="_blank"><i class="fa-solid fa-location-dot"></i></td>
                <td>
                    @if($dvalue->punch_out !== null)
                        @php
                            echo date('h:i A', strtotime($dvalue->punch_out));
                        @endphp
                        &nbsp;<a href="https://www.google.com/maps?q={{ $dvalue->punch_out_lat }},{{ $dvalue->punch_out_long }}" target="_blank"><i class="fa-solid fa-location-dot"></i>
                    @else 
                        00:00
                    @endif
                </td>
                <td>
                    @if($dvalue->punch_out !== null)
                        @php 
                            $punchIn = new Carbon\Carbon($dvalue->punch_in);
                            $punchOut = new Carbon\Carbon($dvalue->punch_out);

                            $timeDifference = $punchOut->diff($punchIn)->format('%H:%I');
                            echo $timeDifference . ' Hr';
                        @endphp
                    @else
                        00:00 Hr
                    @endif
                </td>
                @can('edit-attendance-correction')
                    <td>
                        <a href="{{ route('attendancecorrection.edit', $dvalue->id) }}"><i class="text-primary ti ti-pencil"></i></a>
                    </td>
                @endcan
            </tr>
        @empty 
            <tr>
                <td colspan="6" class="text-center">No Data Found</td>
            </tr>
        @endforelse
    </tbody>
</table>