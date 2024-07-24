    @extends('layout.admin_default_layout')
    @section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">
                        <a href="{{ route('dashboard') }}" class="text-reset">Dashboard</a> / 
                        <a href="{{ route('salary.index') }}" class="text-reset">Salary</a> / 
                    </span> Add
                </h4>
            </div>
            
            <form action="">
                <div class="col-xl justify-content-center d-flex">
                    <div class="card mb-4 w-px-500">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="col-mb-3">
                                    <label class="form-label" for="basic-default-fullname">Select Month & Year </label>
                                    <input type="month" name="month_year" class="form-control jsMonthYear" max="{{ date('Y-m') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Leaves</th>
                                    <th>Monthly Salary</th>
                                    <th>Total Deduction</th>
                                    <th>Payment Type</th>
                                    <th>Is Salary Give</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center mt-lg-3">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ asset('admin/assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">Maven Analytics</h6>
                                                <small class="text-truncate text-muted">Business Intelligence</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-0">Casual Leave : 1</h6>
                                        </div>
                                    </td>
                                    <td>
                                        10000
                                    </td>
                                    <td>
                                        total deduction
                                    </td>
                                    <td>
                                        <select name="" class="form-select">
                                            <option value="">Select Payment Type</option>
                                            @foreach(config('custom.payment_type') as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="" class="form-select">
                                            <option value="">Select Is Salary Give</option>
                                            <option value="">Yes</option>
                                            <option value="">No</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pt-4 mb-4 justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary">Submit</button>&nbsp;
                        <a href="{{ route('user.index') }}" class="btn btn-label-secondary waves-effect">Back</a>
                    </div>
                </div>
            </form>
        </div>
    @endsection
    @push('script')
        <script type="text/javascript">
            $(document).on('change', '.jsMonthYear', function() {
               var month = $(this).val();
               console.log(month);
            });
        </script>
    @endpush