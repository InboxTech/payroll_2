    @switch($row->is_approved)
    @case(0) 
        Pending
        @break;
    @case(1)
        <i class="fa-solid fa-thumbs-up text-success" title="Leave is Approved"></i>
        @break;
    @case(2)
        <i class="fa-solid fa-thumbs-down text-danger" title="Leave Not Approved"></i>
        @break;
    @default
        Something went wrong
    @endswitch