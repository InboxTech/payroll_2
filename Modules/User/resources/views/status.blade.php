    <label class="switch">
        <input type="checkbox" class="switch-input jsStatus" value="{{ $row->id }}" {{ $row->status == 1 ? 'checked' : '' }}/>
        <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
        </span>
    </label>