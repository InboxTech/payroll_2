    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="jsFlashMessage">
                @include('flashmessage.flashmessage')
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Punch In-Out</h4>
                <div class="d-flex align-content-center flex-wrap gap-3">
                    <div class="d-flex gap-3">
                        @if (!empty($punchRecord) && $punchRecord->punch_in_out_status == 1)
                            <form action="{{ route('punchinout.update', $punchRecord->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" id="latitude" name='latitude' value="">
                                <input type="hidden" id="longitude" name='longitude' value="">
                                <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-user-clock"></i>&nbsp;&nbsp;Punch Out</button>
                            </form>
                        @else
                            <form action="{{ route('punchinout.store') }}" method="post">
                                @csrf
                                <input type="hidden" id="latitude" name='latitude' value="">
                                <input type="hidden" id="longitude" name='longitude' value="">
                                <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-user-clock"></i>&nbsp;&nbsp;Punch In</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="accordion" id="collapsibleSection">
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingDeliveryAddress">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseDeliveryAddress" aria-expanded="true" aria-controls="collapseDeliveryAddress">
                                    Searching...
                                </button>
                            </h2>
                            <div id="collapseDeliveryAddress" class="accordion-collapse collapse" data-bs-parent="#collapsibleSection">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label" for="collapsible-phone">Start Date</label>
                                            <input type="date" class="form-control jsStartDate"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="collapsible-end-date">End Date</label>
                                            <input type="date" name="full_name" class="form-control jsEndDate"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-datatable text-nowrap">
                    <table class="data-table table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Your Name</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Punch In</th>
                                <th class="text-center">Punch Out</th>
                                <th class="text-center">Total Time</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script>
            getLocation();
            function getLocation() 
            {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    // If geolocation is not supported
                    document.getElementById('latitude').value = "";
                    document.getElementById('longitude').value = "";
                    console.log('Geolocation is not supported by this browser.');
                }
            }

            function showPosition(position) 
            {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }

            $(function () {
                window.table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    order: [],
                    ajax: {
                        url:"{{ route('punchinout.index') }}",
                        data: function (d) {
                            d.start_date = $('.jsStartDate').val(),
                            d.end_date = $('.jsEndDate').val()
                        }
                    },
                    columns: [
                        { data: 'name', name: 'name', orderable: false, searchable: false},
                        { data: 'date', name: 'date', orderable: false, searchable: false},
                        { data: 'punch_in', name: 'punch_in', orderable: false, searchable: false},
                        { data: 'punch_out', name: 'punch_out', orderable: false, searchable: false},
                        { data: 'total_time', name: 'total_time', orderable: false, searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                });
        
                $(".form-control").keyup(function(){
                    table.draw();
                });
                
                $(".form-control").change(function(){
                    table.draw();
                });
            });
        </script>
    @endpush