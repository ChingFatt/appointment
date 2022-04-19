<x-layout.backend>
    <div class="content">
    	<div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Details</h3>
                @role('admin')
                <x-button.listing route="{{ route('admin.merchant.index') }}"/>
                @endrole
                <x-button.edit route="{{ route('admin.merchant.edit', $merchant) }}"/>
                @role('admin')
                <x-button.delete route="{{ route('admin.merchant.destroy', $merchant) }}" redirect="{{ route('admin.merchant.index') }}"/>
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
                                <x-button.show route="{{ route('admin.service.show', $service) }}"/>
                                <x-button.edit route="{{ route('admin.service.edit', $service) }}"/>
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
                                <x-button.show route="{{ route('admin.outlet.show', $outlet) }}"/>
                                <x-button.edit route="{{ route('admin.outlet.edit', $outlet) }}"/>
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