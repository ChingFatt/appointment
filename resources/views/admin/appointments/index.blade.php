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
@endsection

@section('content')
<!-- Page Content -->
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Listing</h3>
            {!! Form::btnCreate(route('admin.industry.create')) !!}
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-borderless table-striped table-vcenter js-dataTable-full">
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
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->appointment_no }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->fullname }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->merchant->merchant_code }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->outlet->outlet_code }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->date }}</td>
                        <td class="d-sm-table-cell">{{ $appointment->time }}</td>
                        <td class="d-sm-table-cell">{!! $appointment->appointment_status !!}</td>
                        <td>
                            {!! Form::btnView(route('admin.appointment.show', $appointment)) !!}
                            {!! Form::btnEdit(route('admin.appointment.edit', $appointment)) !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
<!-- END Page Content -->
@endsection