<div>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Holiday Name & Date</th>
                <th>Status</th>
                @canany(['edit-holiday-leave', 'delete-holiday-leave'])
                    <th>Actions</th>
                @endcanany
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @forelse($holidayLeaves as $value)
                <tr>
                    <td>{{ $value->holiday_name }}<br><strong>Date : </strong>{{ date('d-m-Y', strtotime($value->holiday_date)) }}</td>
                    <td>
                        @if($value->status == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    @canany(['edit-holiday-leave', 'delete-holiday-leave'])
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                <div class="dropdown-menu">
                                    @can('edit-holiday-leave')
                                        <a class="dropdown-item" href="{{ route('holidayleave.edit', $value->id) }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                                    @endcan
                                    @can('delete-holiday-leave')
                                        <a class="dropdown-item" href="{{ route('holidayleave.delete', $value->id) }}" onclick="return confirm('Are you sure you want to delete?');"><i class="ti ti-trash me-1"></i> Delete</a>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    @endcanany
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">There are no Leaves.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
