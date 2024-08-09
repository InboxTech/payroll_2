{{ date('h:i A', strtotime($row->punch_in)) }} &nbsp;
@can('view-location')
    <a href="javascript:void(0);"><i class="fa-solid fa-location-dot"></i></a>
@endcan