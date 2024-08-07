    <div class="d-flex align-items-center mt-lg-3">
        <div class="avatar me-3 avatar-sm">
            @if($row->profile_image)
                <img src="{{ asset('storage/'.$row->profile_image) }}" alt="" class="rounded-circle" />
            @else
                <img src="{{ asset('admin/assets/img/default-profile.jpg') }}" alt="" class="rounded-circle" />
            @endif
        </div>
        <div class="d-flex flex-column">
            <h6 class="mb-0">{{ $row->full_name }}</h6>
            <small class="text-truncate text-muted">{{ $row->designation->name }}</small>
        </div>
    </div>