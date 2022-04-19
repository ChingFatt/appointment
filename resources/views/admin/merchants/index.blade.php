<x-layout.backend>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Listing</h3>
                @role('admin')
                <x-button.create route="{{ route('admin.merchant.create') }}"/>
                @endrole
            </div>
            <div class="block-content block-content-full">
                <x-table class="js-datatable">
                    <x-slot name="head">
                        <x-table.heading>ID</x-table.heading>
                        <x-table.heading>Name</x-table.heading>
                        <x-table.heading>Merchant Code</x-table.heading>
                        <x-table.heading>Industry</x-table.heading>
                        <x-table.heading>Status</x-table.heading>
                        <x-table.heading class="actions">Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($merchants as $merchant)
                        @can('view-any', $merchant)
                            <x-table.row>
                                <x-table.cell>{{ $merchant->id }}</x-table.cell>
                                <x-table.cell>{{ $merchant->name }}</x-table.cell>
                                <x-table.cell>{{ $merchant->merchant_code }}</x-table.cell>
                                <x-table.cell>{{ $merchant->industry->name }}</x-table.cell>
                                <x-table.cell>{!! $merchant->published !!}</x-table.cell>
                                <x-table.cell>
                                    <x-button.show route="{{ route('admin.merchant.show', $merchant) }}"/>
                                    <x-button.edit route="{{ route('admin.merchant.edit', $merchant) }}"/>
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
