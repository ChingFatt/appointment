@extends('layouts.backend')

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
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

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

    @include('layouts.admin.sweetalert', ['route' => route('admin.outlet.destroy', $outlet), 'redirect' => route('admin.merchant.show', $outlet->merchant->id)])
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            {{-- <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Datepicker</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="input-group">
                                <input type="text" class="js-datepicker start form-control" id="date" name="date" data-week-start="1" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="si si-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-group">
                                <div class="input-group datepair">
                                    <input type="text" class="time start form-control" name="date" placeholder="From" autocomplete="off">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text font-w600">
                                            <i class="fa fa-fw fa-arrow-right"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="time end form-control" name="date2" placeholder="To" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Details</h3>
                    {!! Form::btnBack(route('admin.outlet.index')) !!}
                    {!! Form::btnEdit(route('admin.outlet.edit', $outlet)) !!}
                    {!! Form::btnDelete() !!}
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
                                <label for="example-text-input">Published</label>
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
                            {{-- <iframe 
                                width="100%" 
                                height="400" 
                                frameborder="0" 
                                scrolling="no" 
                                marginheight="0" 
                                marginwidth="0" 
                                loading="lazy" 
                                class="m-0 p-0 d-block" 
                                id="map" 
                                src="https://maps.google.com/maps?q={{ $outlet->latitude }},{{ $outlet->longitude }}&z=18&amp;output=embed"
                            >
                            </iframe> --}}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Employee ({{ count($outlet->employees) }})</h3>
                    {!! Form::btnModalCreate('#employee-modal') !!}
                </div>
                <div class="block-content block-content-full">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter js-dataTable-full ajax-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Employee Code</th>
                                    <th class="actions">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($outlet->employees as $employee)
                                <tr>
                                   <td>{{ $employee->name }}</td>
                                   <td>{{ $employee->employee_code }}</td>
                                   <td>
                                        {!! Form::btnView(route('admin.employee.show', $employee)) !!}
                                        {!! Form::btnEdit(route('admin.employee.edit', $employee)) !!}
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Services</h3>
                </div>
                <div class="table-responsive block-content p-0">
                    <table class="table table-borderless table-striped table-vcenter block-table">
                        <tbody>
                            @foreach($services as $code => $name)
                            <tr>
                               <td>{{ $name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Operating Hours</h3>
                    @empty ($outlet->operating_hour)
                    {!! Form::btnModalCreate('#operating-modal') !!}
                    @else
                    {!! Form::btnEdit(route('admin.operating_hour.edit', $outlet->operating_hour->id)) !!}
                    @endempty
                </div>
                @isset ($outlet->operating_hour)
                <div class="table-responsive block-content p-0">
                    <table class="table table-borderless table-striped table-vcenter block-table">
                        <tbody>
                            @php
                                $week = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                            @endphp
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
        </div>
    </div>
</div>

<div class="modal fade" id="employee-modal" tabindex="-1" role="dialog" aria-labelledby="service-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Employee</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    @include('admin.employees.form')
                </div>
                <div class="p-2 text-right border-top">
                    <button type="button" class="btn btn-alt-secondary mr-1" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-alt-primary">Save</button>
                </div>
             {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="operating-modal" tabindex="-1" role="dialog" aria-labelledby="service-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Operating Hours</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    @include('admin.operating_hours.form')
                </div>
                <div class="p-2 text-right border-top">
                    <button type="button" class="btn btn-alt-secondary mr-1" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-alt-primary">Save</button>
                </div>
             {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
jQuery('.js-datepicker').datepicker({
    startDate: '0d',
    todayHighlight: true,
    autoclose: true,
    multidate: true,
    daysOfWeekDisabled: [{!! json_encode($picker['daysOfWeekDisabled'] ?? '') !!}],
    datesDisabled: [
        "2021-08-01",
        "2021-08-15",
        "2021-08-31"
    ]
}).on('changeDate', function(e) {
    console.log('changed');
});;

jQuery('.time').timepicker({
    step: {!! $picker['interval'] ?? 30 !!},
    minTime: '{!! $picker['start_time'] ?? '' !!}',
    maxTime: '{!! $picker['end_time'] ?? '' !!}',
    forceRoundTime: false,
    disableTimeRanges: [
        [{!! json_encode($picker['rest_start_time'] ?? '') !!}, {!! json_encode($picker['rest_end_time'] ?? '') !!}]
    ]
});

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