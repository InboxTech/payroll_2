<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
      <i class="ti ti-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">
        @can('edit-employee')
            <a href="{{ route('user.edit', $row->id) }}" class="dropdown-item" title="Edit Employee"><i class="ti ti-pencil me-1"></i> Edit</a>
        @endcan
        @if($row->is_generate_offer_letter == 1)
            <a href="{{ asset('storage/offer-letter/'.$row->offer_letter) }}" target="_blank" class="dropdown-item" title="View Offer Letter"><i class="ti ti-file-description"></i> View Offer Letter</a>
        @endif
    </div>
</div>