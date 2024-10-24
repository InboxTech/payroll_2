@can('edit-leave-apply')
    @if($row->manager_approval_status == 1 || $row->manager_approval_status == 2)

    @else 
        <a href="{{ route('leaveapply.edit', $row->id) }}" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
    @endif
@endcan
