@can('edit-project')
    <a href="{{ route('project.edit', $row->id) }}"><i class="text-primary ti ti-pencil"></i></a>
@endcan
