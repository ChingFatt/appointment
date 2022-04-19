<x-layout.backend>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Listing</h3>
            </div>
            <div class="block-content block-content-full">
                <x-table class="js-datatable">
                    <x-slot name="head">
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading>Name</x-table.heading>
                        <x-table.heading>Outlet Code</x-table.heading>
                        <x-table.heading>Merchant Code</x-table.heading>
                        <x-table.heading>Status</x-table.heading>
                        <x-table.heading class="actions">Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($outlets as $outlet)
                        @can('view-any', $outlet)
                            <x-table.row>
                                <x-table.cell>{{ $outlet->id }}</x-table.cell>
                                <x-table.cell>{{ $outlet->name }}</x-table.cell>
                                <x-table.cell>{{ $outlet->outlet_code }}</x-table.cell>
                                <x-table.cell>{{ $outlet->merchant->merchant_code }}</x-table.cell>
                                <x-table.cell>{!! $outlet->published !!}</x-table.cell>
                                <x-table.cell>
                                    <x-button.show route="{{ route('admin.outlet.show', $outlet) }}"/>
                                    <x-button.edit route="{{ route('admin.outlet.edit', $outlet) }}"/>
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
