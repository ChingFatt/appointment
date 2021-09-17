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

<x-layout.backend>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Listing</h3>
            </div>
            <div class="block-content block-content-full table-responsive">
                <table class="table table-borderless table-hover table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="d-none d-md-table-cell text-center" style="width: 80px;">ID</th>
                            <th>Name</th>
                            <th>Outlet Code</th>
                            <th class="d-none d-md-table-cell">Merchant Code</th>
                            <th class="d-none d-md-table-cell">Status</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outlets as $outlet)
                        <tr>
                            <td class="d-none d-md-table-cell text-center">{{ $outlet->id }}</td>
                            <td class="d-sm-table-cell">{{ $outlet->name }}</td>
                            <td class="d-sm-table-cell">{{ $outlet->outlet_code }}</td>
                            <td class="d-none d-md-table-cell">{{ $outlet->merchant->merchant_code }}</td>
                            <td class="d-none d-md-table-cell">{!! $outlet->published !!}</td>
                            <td>
                                {!! Form::btnView(route('admin.outlet.show', $outlet)) !!}
                                {!! Form::btnEdit(route('admin.outlet.edit', $outlet)) !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-pagination :model="$outlets"/>
            </div>
        </div>
    </div>
</x-layout.backend>
