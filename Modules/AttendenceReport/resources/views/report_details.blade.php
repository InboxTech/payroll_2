<table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Present / Absent</th>
            <th>Punch In Time</th>
            <th>Punch Out Time</th>
            <th>Total Hours</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        @forelse($data as $dkey => $dvalue)
            <tr>
                <td>{{ \Carbon\Carbon::parse($dvalue->date)->format('d-m-Y') }}</td>
                <td>@if($dvalue) Present @else Absent @endif</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp($dvalue->punch_in)->format('d-m-Y H:i A') }} &nbsp;<a href="https://www.google.com/maps?q={{ $dvalue->punch_in_lat }},{{ $dvalue->punch_in_long }}" target="_blank"><i class="fa-solid fa-location-dot"></i></td>
                <td>
                    @if($dvalue->punch_out !== null)
                        @php
                            echo \Carbon\Carbon::createFromTimestamp($dvalue->punch_out)->format('d-m-Y H:i A')
                        @endphp
                        &nbsp;<a href="https://www.google.com/maps?q={{ $dvalue->punch_out_lat }},{{ $dvalue->punch_out_long }}" target="_blank"><i class="fa-solid fa-location-dot"></i>
                    @else 
                        00-00-0000 00:00
                    @endif
                </td>
                <td>
                    @if($dvalue->punch_out !== null)
                        @php 
                            $punchIn = \Carbon\Carbon::createFromTimestamp($dvalue->punch_in);
                            $punchOut = \Carbon\Carbon::createFromTimestamp($dvalue->punch_out);
                            $timeDifference = $punchOut->diff($punchIn)->format('%H:%I');
                            echo $timeDifference . ' Hr';
                        @endphp
                    @else
                        00:00 Hr
                    @endif
                </td>
            </tr>
        @empty 
            <tr>
                <td colspan="5" class="text-center">No Data Found</td>
            </tr>
        @endforelse
    </tbody>
</table>