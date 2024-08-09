    <div class="d-flex align-items-center mt-lg-3">
        <div class="avatar me-3 avatar-sm">
            @if($row->user->profile_image)
                <img src="{{ asset('storage/'.$row->user->profile_image) }}" alt="Avatar" class="rounded-circle" />
            @else
                <img src="{{ asset('admin/assets/img/default-profile.jpg') }}" alt="Avatar" class="rounded-circle" />
            @endif
        </div>
        <div class="d-flex flex-column">
            <h6 class="mb-0">{{ $row->user->first_name.' '.$row->user->last_name }}</h6>
            <small class="text-truncate text-muted">{{ $row->user->designation->name }}</small>
        </div>
    </div>