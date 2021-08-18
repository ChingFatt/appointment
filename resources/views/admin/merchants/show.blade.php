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

    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

    @include('layouts.admin.sweetalert', ['route' => route('admin.merchant.destroy', $merchant), 'redirect' => route('admin.merchant.index')])
@endsection

@section('content')
<div class="content">
	<div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Details</h3>
            @role('admin')
            {!! Form::btnBack(route('admin.merchant.index')) !!}
            @endrole
            {!! Form::btnEdit(route('admin.merchant.edit', $merchant)) !!}
            {!! Form::btnDelete() !!}
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Name</label>
                        <div>{{ $merchant->name }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Merchant Code</label>
                        <div>{{ $merchant->merchant_code }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Industry</label>
                        <div>{{ $merchant->industry->name }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Published</label>
                        <div>{!! $merchant->published !!}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Created</label>
                        <div>{{ $merchant->created_at }}</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Updated</label>
                        <div>{{ $merchant->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Outlets ({{ count($merchant->outlets) }})</h3>
            {!! Form::btnModalCreate('#outlet-modal') !!}
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full ajax-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Outlet Code</th>
                            <th class="d-none d-md-table-cell">Phone</th>
                            <th class="d-none d-md-table-cell">Email</th>
                            <th class="d-none d-md-table-cell">Published</th>
                            <th class="actions">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchant->outlets as $outlet)
                        <tr>
                           <td>{{ $outlet->name }}</td>
                           <td>{{ $outlet->outlet_code }}</td>
                           <td class="d-none d-md-table-cell">{{ $outlet->phone }}</td>
                           <td class="d-none d-md-table-cell">{{ $outlet->email }}</td>
                           <td class="d-none d-md-table-cell">{!! $outlet->published !!}</td>
                           <td>
                                {!! Form::btnView(route('admin.outlet.show', $outlet)) !!}
                                {!! Form::btnEdit(route('admin.outlet.edit', $outlet)) !!}
                           </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Services ({{ count($merchant->services) }})</h3>
            {!! Form::btnModalCreate('#service-modal') !!}
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full ajax-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Duration</th>
                            <th class="d-none d-md-table-cell">Service Code</th>
                            <th class="d-none d-md-table-cell">Created</th>
                            <th class="actions">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($merchant->services as $service)
                        <tr>
                           <td>{{ $service->name }}</td>
                           <td>{!! $service->durations !!}</td>
                           <td class="d-none d-md-table-cell">{{ $service->service_code }}</td>
                           <td class="d-none d-md-table-cell">{{ $service->created_at }}</td>
                           <td>
                                {!! Form::btnView(route('admin.service.show', $service)) !!}
                                {!! Form::btnEdit(route('admin.service.edit', $service)) !!}
                           </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="outlet-modal" tabindex="-1" role="dialog" aria-labelledby="outlet-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Outlet</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    @include('admin.outlets.form')
                </div>
                <div class="p-2 text-right border-top">
                    <button type="button" class="btn btn-alt-secondary mr-1" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-alt-primary">Save</button>
                </div>
             {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="service-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Service</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    @include('admin.services.form')
                </div>
                <div class="p-2 text-right border-top">
                    <button type="button" class="btn btn-alt-secondary mr-1" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-alt-primary">Save</button>
                </div>
             {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection