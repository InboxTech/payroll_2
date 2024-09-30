{{ date('h:i A', strtotime($row->punch_in)) }} &nbsp;
@can('view-location')
    <a href="https://www.google.com/maps?q={{ $row->punch_in_lat }},{{ $row->punch_in_long }}" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
@endcan