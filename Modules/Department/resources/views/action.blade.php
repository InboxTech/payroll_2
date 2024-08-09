@can('edit-department')
    <a href="{{ route('department.edit', $row->id) }}"><i class="text-primary ti ti-pencil"></i></a>
@endcan
