@can('view-attendance-report')
    <a href="{{ route('attendencereport.report', $row->id) }}" class="btn btn-sm btn-icon item-edit"><i class="fa-solid fa-calendar-days fa-lg"></i></a>
@endcan