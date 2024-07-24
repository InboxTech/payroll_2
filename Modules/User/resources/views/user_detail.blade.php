    <div class="d-flex align-items-center mt-lg-3">
        <div class="avatar me-3 avatar-sm">
            <img src="{{ asset('storage/'.$row->profile_image) }}" alt="" class="rounded-circle" />
        </div>
        <div class="d-flex flex-column">
            <h6 class="mb-0">{{ $row->full_name }}</h6>
            <small class="text-truncate text-muted">{{ $row->roles->first()->name ?? '' }}</small>
        </div>
    </div>