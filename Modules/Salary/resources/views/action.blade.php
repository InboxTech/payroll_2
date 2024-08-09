<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
      <i class="ti ti-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">
        @can('edit-salary')
            <a href="{{ route('salary.edit', $row->id) }}" class="dropdown-item" title="Edit Salary"><i class="ti ti-pencil me-1"></i> Edit</a>
        @endcan
        @can('show-salary')
            <a href="{{ route('salary.show', $row->id) }}" class="dropdown-item" title="View Salary"><i class="ti ti-eye me-1"></i> View</a>
        @endcan
        @if($row->is_salary_slip_generate == 1)
            <a href="{{ asset('storage/'.$row->salary_slip_path) }}" target="_blank" class="dropdown-item" title="View Salary Slip"><i class="ti ti-file-description"></i> View Salary Slip</a>
        @endif
    </div>
</div>