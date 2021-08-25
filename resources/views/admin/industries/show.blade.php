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
    
    @include('layouts.admin.sweetalert', ['route' => route('admin.industry.destroy', $industry), 'redirect' => route('admin.industry.index')])
@endsection

@section('content')
<div class="content">
	<div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Details</h3>
            {!! Form::btnEdit(route('admin.industry.edit', $industry)) !!}
            {!! Form::btnDelete() !!}
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Name</label>
                        <div>{{ $industry->name }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Created</label>
                        <div>{{ $industry->created_at }}</div>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="form-group">
                        <label for="example-text-input">Updated</label>
                        <div>{{ $industry->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Merchants</h3>
            @role('admin')
            {!! Form::btnCreate(route('admin.merchant.create')) !!}
            @endrole
        </div>
        <div class="block-content block-content-full">
            {{-- {{ $dataTable->table() }} --}}
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-borderless table-striped table-vcenter js-dataTable-full ajax-table">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell text-center" style="width: 80px;">#</th>
                        <th>Name</th>
                        <th>Merchant Code</th>
                        <th class="d-none d-md-table-cell">Industry</th>
                        <th class="d-none d-md-table-cell">Publish</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($industry->merchants as $merchant)
                    @can('view-any', $merchant)
                    <tr>
                        <td class="d-none d-md-table-cell text-center">{{ $loop->iteration }}</td>
                        <td class="d-sm-table-cell">{{ $merchant->name }}</td>
                        <td class="d-sm-table-cell">{{ $merchant->merchant_code }}</td>
                        <td class="d-none d-md-table-cell">{{ $merchant->industry->name }}</td>
                        <td class="d-none d-md-table-cell">{!! $merchant->published !!}</td>
                        <td>
                            {!! Form::btnView(route('admin.merchant.show', $merchant)) !!}
                            {!! Form::btnEdit(route('admin.merchant.edit', $merchant)) !!}
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