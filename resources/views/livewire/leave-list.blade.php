<div>
    <table class="table">
        <thead>
            <tr>
                <th>Leave Type Name</th>
                <th>Number of Leave</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse($leave_list as $value)
                <tr>
                    <td>{{ $value->leave_type_name }}</td>
                    <td>{{ $value->number_of_leaves }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('leave.edit', $value->id) }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                <a class="dropdown-item" href="{{ route('leave.delete', $value->id) }}" onclick="return confirm('Are you sure you want to delete?');"><i class="ti ti-trash me-1"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">There are no Leaves.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
