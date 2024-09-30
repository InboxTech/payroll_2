    @if($row->status == 1)
        <span class="badge bg-success">Active</span>
    @else
        <span class="badge bg-danger">Inactive</span>
    @endif