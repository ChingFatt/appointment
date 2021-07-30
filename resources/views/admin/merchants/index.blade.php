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

@section('scripts')
    <!-- DataTable JS Code -->
    {{--<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{ $dataTable->scripts() }} --}}
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Listing</h3>
                {!! Form::btnCreate(route('admin.merchant.create')) !!}
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
                        @foreach ($merchants as $merchant)
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
