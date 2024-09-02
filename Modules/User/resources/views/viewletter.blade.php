    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard / Employee</span> / View Letter </h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-danger"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center table-responsive text-nowrap" id="User">
                        <thead>
                            <tr>
                                <th class="text-center">Letter Name</th>
                                <th class="text-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($userDocument as $key => $value)
                                <tr>
                                    @switch($value->document_type)
                                        @case(1)
                                            <td>Internship Offer Letter</td>
                                            <td><a href="{{ asset('storage/'.$value->document_name) }}" target="_blank"><i class="menu-icon tf-icons ti ti-file-arrow-right"></i></a></td>
                                            @break
                                        @case(2)
                                            <td>Confirmation Letter</td>
                                            <td><a href="{{ asset('storage/'.$value->document_name) }}" target="_blank"><i class="menu-icon tf-icons ti ti-file-arrow-right"></i></a></td>
                                            @break
                                        @case(3)
                                            <td>Offer Letter</td>
                                            <td><a href="{{ asset('storage/'.$value->document_name) }}" target="_blank"><i class="menu-icon tf-icons ti ti-file-arrow-right"></i></a></td>
                                            @break
                                        @case(4)
                                            <td>Appoitment Letter</td>
                                            <td><a href="{{ asset('storage/'.$value->document_name) }}" target="_blank"><i class="menu-icon tf-icons ti ti-file-arrow-right"></i></a></td>
                                            @break
                                        @case(5)
                                            <td>Experience or Releaving Letter</td>
                                            <td><a href="{{ asset('storage/'.$value->document_name) }}" target="_blank"><i class="menu-icon tf-icons ti ti-file-arrow-right"></i></a></td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection