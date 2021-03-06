@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>

    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Sweetalert2 JS Code -->
    <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/be_forms_validation.min.js') }}"></script>

    <script src="{{ asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.js') }}"></script>

    <script src="{{ asset('/js/plugins/jquery-timepicker/datepair.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.datepair.min.js') }}"></script>

    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
@endsection

<x-layout.backend>
<div class="content">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Details</h3>
                    @role('admin')
                    <x-button.listing route="{{ route('admin.outlet.index') }}"/>
                    @endrole
                    <x-button.edit route="{{ route('admin.outlet.edit', $outlet) }}"/>
                    <x-button.delete route="{{ route('admin.outlet.destroy', $outlet) }}" redirect="{{ route('admin.merchant.show', $outlet->merchant->id) }}"/>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Name</label>
                                <div>{{ $outlet->name }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Outlet Code</label>
                                <div>{{ $outlet->outlet_code }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Merchant Code</label>
                                <div><a href="{{ route('admin.merchant.show', $outlet->merchant->id) }}">{{ $outlet->merchant->merchant_code }}</a></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Email</label>
                                <div>{{ $outlet->email }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Phone</label>
                                <div>{{ $outlet->phone }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Description</label>
                                <div>{{ $outlet->description }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Status</label>
                                <div>{!! $outlet->published !!}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Created</label>
                                <div>{{ $outlet->created_at }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="example-text-input">Updated</label>
                                <div>{{ $outlet->updated_at }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (isset($outlet->latitude) && isset($outlet->longitude))
                <div class="col-md-12 col-lg-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Address</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content p-0">
                            <div class="block block-content shadow-sm" id="map-place-card">
                                <address class="font-size-sm">
                                    {{ $outlet->address }}<br>
                                    {{ $outlet->address2 }}<br>
                                    {{ $outlet->postcode }}, {{ $outlet->state }}<br>
                                    {{ $outlet->country }}<br><br>
                                    <i class="fa fa-phone"></i> {{ $outlet->phone }}<br>
                                    <i class="fa fa-envelope"></i> <a href="javascript:void(0)">{{ $outlet->email }}<br></a>
                                </address>
                            </div>
                            <div style="width: 100%; height: 400px" id="map"></div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Employee ({{ count($outlet->employees) }})</h3>
                    @role('admin|merchant')
                    <x-btn-modal modal="#employee-modal"/>
                    @endrole
                </div>
                <div class="block-content block-content-full">
                    <x-table class="js-datatable">
                        <x-slot name="head">
                            <x-table.heading>ID</x-table.heading>
                            <x-table.heading>Name</x-table.heading>
                            <x-table.heading>Employee Code</x-table.heading>
                            <x-table.heading class="actions">Actions</x-table.heading>
                        </x-slot>

                        <x-slot name="body">
                            @foreach ($outlet->employees as $employee)
                                <x-table.row>
                                    <x-table.cell>{{ $employee->id }}</x-table.cell>
                                    <x-table.cell>{{ $employee->name }}</x-table.cell>
                                    <x-table.cell>{{ $employee->employee_code }}</x-table.cell>
                                    <x-table.cell>
                                        <x-button.show route="{{ route('admin.employee.show', $employee) }}"/>
                                        <x-button.edit route="{{ route('admin.employee.edit', $employee) }}"/>
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Email Config</h3>
                    @role('admin|merchant')
                    <x-button.create route="{{ route('admin.outlet.email_config.create', $outlet) }}"/>
                    @endrole
                </div>
                <div class="block-content block-content-full">
                    <x-table class="js-datatable">
                        <x-slot name="head">
                            <x-table.heading>ID</x-table.heading>
                            <x-table.heading>Status</x-table.heading>
                            <x-table.heading class="actions">Actions</x-table.heading>
                        </x-slot>

                        <x-slot name="body">
                            @foreach ($email_configs as $config)
                                <x-table.row>
                                    <x-table.cell>{{ $config->id }}</x-table.cell>
                                    <x-table.cell>{{ $config->status }}</x-table.cell>
                                    <x-table.cell>
                                        <x-button.edit route="{{ route('admin.email_config.edit', $config) }}"/>
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Services</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="table-responsive block-content p-0">
                    <table class="table table-borderless table-striped table-vcenter block-table">
                        <tbody>
                            @isset($outlet_services)
                            @foreach($outlet_services as $code => $name)
                            <tr>
                               <td>{{ $name }}</td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Operating Hours</h3>
                    <div class="block-options">
                        @empty ($outlet->operating_hour)
                        <x-button.create route="{{ route('admin.outlet.operating_hour.create', $outlet) }}"/>
                        @else
                        <x-button.edit route="{{ route('admin.operating_hour.edit', $outlet->operating_hour->id) }}"/>
                        @endempty
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                    
                </div>
                @isset ($outlet->operating_hour)
                <div class="table-responsive block-content p-0">
                    <table class="table table-borderless table-striped table-vcenter block-table">
                        <tbody>
                            @foreach($week as $day)
                                @if(array_key_exists($day, $picker['operating_hours']))
                                    @php
                                        $sorted[$day] = $picker['operating_hours'][$day];
                                    @endphp
                                @endif
                            @endforeach
                            @foreach ($sorted as $day => $value)
                                <tr>
                                    <td>
                                        <div class="font-weight-bold">
                                            {{ $day }}
                                        </div>
                                        @isset ($value['start_time'])
                                        {{ $value['start_time'] }} - {{ $value['end_time'] }}
                                        @else
                                        Off
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endisset
            </div>
            @isset ($outlet->operating_hour->public_holidays)
            <div class="block block-rounded">
                 <div class="block-header block-header-default">
                    <h3 class="block-title">Public Holidays</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                    </div>
                </div>
                <div class="table-responsive block-content p-0">
                    <table class="table table-borderless table-striped table-vcenter block-table">
                        <tbody>
                            @foreach ($outlet->operating_hour->public_holidays as $date => $holiday)
                                <tr>
                                    <td>
                                        <div class="font-weight-bold">
                                            {{ $date }}
                                        </div>
                                        {{ $holiday['name'] }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endisset
        </div>
    </div>
</div>

<x-modal modal="employee-modal">
    <x-slot name="header">
        Employee
    </x-slot>
    @include('admin.employees.form')
</x-modal>

@push('scripts')
<script>
jQuery('.datepair.operating-hour').datepair({
    defaultTimeDelta: 8 * 60 * 60 * 1000,
});
jQuery('.datepair.rest-time').datepair({
    defaultTimeDelta: 1 * 60 * 60 * 1000,
});


var latitude = {{ $outlet->latitude ?? 0 }};
var longitude = {{ $outlet->longitude ?? 0 }};

//var icon = new H.map.Icon('{{ asset('/images/marker.png') }}');

function addMarkersToMap(map, lat = latitude, lng = longitude) {
    var marker = new H.map.Marker({lat: lat, lng: lng}, {
        volatility: true
    });
    
    marker.draggable = false;
    map.addObject(marker);
}

/**
* Boilerplate map initialization code starts below:
*/

//Step 1: initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey
var platform = new H.service.Platform({
    apikey: '4PY80wCpjhNEbHjoRp8FwIAZ7tAwhbTPf771iq4W1pU'
});
var defaultLayers = platform.createDefaultLayers();

//Step 2: initialize a map - this map is centered over Europe
var map = new H.Map(document.getElementById('map'),
    defaultLayers.vector.normal.map,{
        center: {lat: latitude, lng: longitude},
        zoom: 17,
        pixelRatio: window.devicePixelRatio || 1
    });

// add a resize listener to make sure that the map occupies the whole container
window.addEventListener('resize', () => map.getViewPort().resize());

//Step 3: make the map interactive
// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// Create the default UI components
var ui = H.ui.UI.createDefault(map, defaultLayers);

// Now use the map as required...
window.onload = function () {
    addMarkersToMap(map);
}
</script>
@endpush
</x-layout.backend>