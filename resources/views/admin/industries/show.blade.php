@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
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

<x-layout.backend>
    <div class="content">
    	<div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details</h3>
                <x-btn type="edit" :url="route('admin.industry.edit', $industry)"/>
                <x-btn type="delete"/>
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
                <x-table class="js-dataTable-full">
                    <x-slot name="head">
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading>Name</x-table.heading>
                        <x-table.heading>Merchant Code</x-table.heading>
                        <x-table.heading>Industry</x-table.heading>
                        <x-table.heading>Status</x-table.heading>
                        <x-table.heading class="actions">Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($industry->merchants as $merchant)
                        @can('view-any', $merchant)
                            <x-table.row>
                                <x-table.cell>{{ $merchant->id }}</x-table.cell>
                                <x-table.cell>{{ $merchant->name }}</x-table.cell>
                                <x-table.cell>{{ $merchant->merchant_code }}</x-table.cell>
                                <x-table.cell>{{ $merchant->industry->name }}</x-table.cell>
                                <x-table.cell>{!! $merchant->published !!}</x-table.cell>
                                <x-table.cell>
                                    <x-btn type="show" :url="route('admin.merchant.show', $merchant)"/>
                                    <x-btn type="edit" :url="route('admin.merchant.edit', $merchant)"/>
                                </x-table.cell>
                            </x-table.row>
                        @endcan
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
</x-layout.backend>