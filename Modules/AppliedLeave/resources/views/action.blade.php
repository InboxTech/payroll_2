@can('edit-applied-leave')
    <a href="{{ route('appliedleave.edit', $row->id) }}" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil" title="Edit"></i></a>
@endcan