@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <!-- Sweetalert2 JS Code -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    
    @include('layouts.admin.sweetalert', ['route' => route('admin.employee.destroy', $employee), 'redirect' => route('admin.outlet.show', $employee->outlet_id)])
@endsection

@section('content')
<div class="content">
	<div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Details</h3>
            {!! Form::btnEdit(route('admin.employee.edit', $employee)) !!}
            {!! Form::btnDelete() !!}
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Name</label>
                        <div>{{ $employee->name }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Employee Code</label>
                        <div>{{ $employee->employee_code }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Outlet Code</label>
                        <div><a href="{{ route('admin.outlet.show', $employee->outlet_id) }}">{{ $employee->outlet->outlet_code }}</a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Created</label>
                        <div>{{ $employee->created_at }}</div>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Updated</label>
                        <div>{{ $employee->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Appointment Today</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-borderless table-striped table-vcenter js-dataTable-buttons">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Appointment No.</th>
                        <th>Customer</th>
                        <th>Merchant</th>
                        <th>Outlet</th>
                        <th>Appointment Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($today_appointments as $appointment)
                    @can('view', $appointment)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->appointment_no }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->fullname }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->merchant->merchant_code }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->outlet->outlet_code }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->date }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->time }}</td>
                        <td class="d-sm-table-cell">
                            <span class="badge badge-{!! $appointment->status_color !!}">{{ $appointment->status }}</span>
                        </td>
                        <td>
                            {!! Form::btnView(route('admin.appointment.show', $appointment)) !!}
                            {!! Form::btnEdit(route('admin.appointment.edit', $appointment)) !!}
                        </td>
                    </tr>
                    @endcan
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Assigned Appointment</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-borderless table-striped table-vcenter js-dataTable-full ajax-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Appointment No.</th>
                        <th>Customer</th>
                        <th>Merchant</th>
                        <th>Outlet</th>
                        <th>Appointment Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    @can('view', $appointment)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->appointment_no }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->fullname }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->merchant->merchant_code }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->outlet->outlet_code }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->date }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->time }}</td>
                        <td class="d-sm-table-cell">
                            <span class="badge badge-{!! $appointment->status_color !!}">{{ $appointment->status }}</span>
                        </td>
                        <td>
                            {!! Form::btnView(route('admin.appointment.show', $appointment)) !!}
                            {!! Form::btnEdit(route('admin.appointment.edit', $appointment)) !!}
                        </td>
                    </tr>
                    @endcan
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection