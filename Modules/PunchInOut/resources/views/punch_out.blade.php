@if($row->punch_out != null)
    {{ date('h:i A', strtotime($row->punch_out)) }} &nbsp;
    @can('view-location')
        <a href="javascript:void(0);"><i class="fa-solid fa-location-dot"></i></a>
    @endcan    
@endif