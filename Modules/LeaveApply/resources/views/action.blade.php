@can('edit-leave-apply')
    @if($row->is_approved == 1 || $row->is_approved == 2)

    @else 
        <a href="{{ route('leaveapply.edit', $row->id) }}" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
    @endif
@endcan
