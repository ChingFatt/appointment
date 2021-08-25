@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
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

    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>

    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Sweetalert2 JS Code -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/be_forms_validation.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    
    @include('layouts.admin.sweetalert', ['route' => route('admin.service.destroy', $service), 'redirect' => route('admin.merchant.show', $service->merchant->id)])
@endsection

@section('content')
<div class="content">
	<div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Details</h3>
            {!! Form::btnEdit(route('admin.service.edit', $service)) !!}
            {!! Form::btnDelete() !!}
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Name</label>
                        <div>{{ $service->name }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Service Code</label>
                        <div>{{ $service->service_code }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Merchant</label>
                        <div><a href="{{ route('admin.merchant.show', $service->merchant->id) }}">{{ $service->merchant->merchant_code }}</a></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Duration</label>
                        <div>{!! $service->durations !!}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Created</label>
                        <div>{{ $service->created_at }}</div>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Updated</label>
                        <div>{{ $service->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Employee ({{ count($employees) }})</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full ajax-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Employee Code</th>
                            <th class="actions">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                           <td>{{ $employee->name }}</td>
                           <td>{{ $employee->employee_code }}</td>
                           <td>
                                {!! Form::btnView(route('admin.employee.show', $employee)) !!}
                                {!! Form::btnEdit(route('admin.employee.edit', $employee)) !!}
                           </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection