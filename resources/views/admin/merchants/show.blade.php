@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>

    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/pages/be_forms_validation.min.js') }}"></script>

    <!-- Sweetalert2 JS Code -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @include('layouts.admin.sweetalert', ['route' => route('admin.merchant.destroy', $merchant), 'redirect' => route('admin.merchant.index')])
@endsection

<x-layout.backend>
    <div class="content">
    	<div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details</h3>
                @role('admin')
                <x-btn type="index" :url="route('admin.merchant.index')"/>
                @endrole
                <x-btn type="edit" :url="route('admin.merchant.edit', $merchant)"/>
                @role('admin')
                <x-btn type="delete"/>
                @endrole
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
                            <label for="example-text-input">Status</label>
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
                <h3 class="block-title">Services ({{ count($merchant->services) }})</h3>
                <x-btn-modal modal="#service-modal"/>
            </div>
            <div class="block-content block-content-full">
                <x-table class="js-datatable">
                    <x-slot name="head">
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading>Name</x-table.heading>
                        <x-table.heading>Duration</x-table.heading>
                        <x-table.heading>Service Code</x-table.heading>
                        <x-table.heading>Created</x-table.heading>
                        <x-table.heading class="actions">Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($merchant->services as $service)
                        <x-table.row>
                            <x-table.cell>{{ $service->id }}</x-table.cell>
                            <x-table.cell>{{ $service->name }}</x-table.cell>
                            <x-table.cell>{{ $service->duration }}</x-table.cell>
                            <x-table.cell>{{ $service->service_code }}</x-table.cell>
                            <x-table.cell>{{ $service->created_at }}</x-table.cell>
                            <x-table.cell>
                                <x-btn type="show" :url="route('admin.service.show', $service)"/>
                                <x-btn type="edit" :url="route('admin.service.edit', $service)"/>
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Outlets ({{ count($merchant->outlets) }})</h3>
                <x-btn-modal modal="#outlet-modal"/>
            </div>
            <div class="block-content block-content-full">
                <x-table class="js-datatable">
                    <x-slot name="head">
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading>Name</x-table.heading>
                        <x-table.heading>Outlet Code</x-table.heading>
                        <x-table.heading>Phone</x-table.heading>
                        <x-table.heading>Email</x-table.heading>
                        <x-table.heading>Status</x-table.heading>
                        <x-table.heading class="actions">Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($merchant->outlets as $outlet)
                        <x-table.row>
                            <x-table.cell>{{ $outlet->id }}</x-table.cell>
                            <x-table.cell>{{ $outlet->name }}</x-table.cell>
                            <x-table.cell>{{ $outlet->outlet_code }}</x-table.cell>
                            <x-table.cell>{{ $outlet->phone }}</x-table.cell>
                            <x-table.cell>{{ $outlet->email }}</x-table.cell>
                            <x-table.cell>{!! $outlet->published !!}</x-table.cell>
                            <x-table.cell>
                                <x-btn type="show" :url="route('admin.outlet.show', $outlet)"/>
                                <x-btn type="edit" :url="route('admin.outlet.edit', $outlet)"/>
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
    <x-modal modal="service-modal">
        <x-slot name="header">
            Service
        </x-slot>
        @include('admin.services.form')
    </x-modal>

    <x-modal modal="outlet-modal">
        <x-slot name="header">
            Outlet
        </x-slot>
        @include('admin.outlets.form')
    </x-modal>
</x-layout.backend>