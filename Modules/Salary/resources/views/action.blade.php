<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
      <i class="ti ti-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">
        <a href="{{ route('salary.edit', $row->id) }}" class="dropdown-item"><i class="ti ti-pencil me-1"></i> Edit</a>
        <a href="{{ route('salary.show', $row->id) }}" class="dropdown-item"><i class="ti ti-eye me-1"></i> View</a>
        @if($row->is_salary_slip_generate == 0)
            <a href="{{ route('salary.generateslip', $row->id) }}" class="dropdown-item"><i class="ti ti-file-description"></i>Generate Salary<br>Slip</a>
        @else
            <a href="" class="dropdown-item"><i class="ti ti-file-description"></i> View Salary Slip</a>
        @endif
    </div>
</div>