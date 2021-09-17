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
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

<x-layout.backend>
<div class="content">
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Listing</h3>
        </div>
        <div class="block-content block-content-full">
             <x-table>
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
                            <x-table.cell><span class="bg-{!! $appointment->status_color !!}-light text-{!! $appointment->status_color !!} font-size-sm font-w600 px-2 py-1 rounded">{{ $appointment->status }}</span></x-table.cell>
                            <x-table.cell>
                                <x-btn type="show" :url="route('admin.appointment.show', $appointment)"/>
                                <x-btn type="edit" :url="route('admin.appointment.edit', $appointment)"/>
                            </x-table.cell>
                        </x-table.row>
                    @endcan
                    @endforeach
                </x-slot>
            </x-table>
            <x-pagination :model="$appointments"/>
        </div>
    </div>
</div>
</x-layout.backend>