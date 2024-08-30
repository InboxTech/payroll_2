<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
      <i class="ti ti-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">
        @can('edit-employee')
            <a href="{{ route('user.edit', $row->id) }}" class="dropdown-item" title="Edit Employee"><i class="ti ti-pencil me-1"></i> Edit</a>
        @endcan
        <a href="{{ route('user.viewletter', $row->id) }}" class="dropdown-item" title="View Letters"><i class="ti ti-file-description"></i> View Letters</a>
        @can('leave-history')
            <a href="{{ route('user.leavehistory', $row->id) }}" class="dropdown-item" title="View Lieave History"><i class="ti ti-calendar me-1"></i> Leave History</a>
        @endcan
        <a href="{{ route('user.salaryhistory', $row->id) }}" class="dropdown-item" title="Salary History"><i class="tf-icons ti ti-file-dollar"></i> Salary History</a>
    </div>
</div>