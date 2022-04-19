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
                    <x-table.heading>Customer</x-table.heading>
                    <x-table.heading>Merchant</x-table.heading>
                    <x-table.heading>Outlet</x-table.heading>
                    <x-table.heading>Date</x-table.heading>
                    <x-table.heading>Time</x-table.heading>
                    <x-table.heading>Status</x-table.heading>
                    <x-table.heading class="actions">Actions</x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @foreach ($appointments as $appointment)
                    @can('view-any', $appointment)
                        <x-table.row>
                            <x-table.cell>{{ $appointment->id }}</x-table.cell>
                            <x-table.cell>{{ $appointment->fullname }}</x-table.cell>
                            <x-table.cell>{{ $appointment->merchant->merchant_code }}</x-table.cell>
                            <x-table.cell>{{ $appointment->outlet->outlet_code }}</x-table.cell>
                            <x-table.cell>{{ $appointment->date }}</x-table.cell>
                            <x-table.cell>{{ $appointment->time }}</x-table.cell>
                            <x-table.cell>
                                <span class="bg-{!! $appointment->status_color !!}-light text-{!! $appointment->status_color !!} font-size-sm font-w600 px-2 py-1 rounded">
                                    {{ $appointment->status }}
                                </span>
                            </x-table.cell>
                            <x-table.cell>
                                <x-button.show route="{{ route('admin.appointment.show', $appointment) }}"/>
                                <x-button.edit route="{{ route('admin.appointment.edit', $appointment) }}"/>
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