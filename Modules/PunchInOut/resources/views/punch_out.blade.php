@if($row->punch_out != null)
    {{ date('h:i A', strtotime($row->punch_out)) }} &nbsp;
    @can('view-location')
        <a href="https://www.google.com/maps?q={{ $row->punch_out_lat }},{{ $row->punch_out_long }}" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
    @endcan    
@endif