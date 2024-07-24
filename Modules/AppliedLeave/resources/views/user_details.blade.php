    <div class="d-flex align-items-center mt-lg-3">
        <div class="avatar me-3 avatar-sm">
            <img src="{{ asset('storage/'.$row->user->profile_image) }}" alt="Avatar" class="rounded-circle" />
        </div>
        <div class="d-flex flex-column">
            <h6 class="mb-0">{{ $row->user->first_name.' '.$row->user->last_name }}</h6>
            <small class="text-truncate text-muted">{{ $row->user->getRoleNames()->first() }}</small>
        </div>
    </div>