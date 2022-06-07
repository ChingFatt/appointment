@php
    $route = Route::currentRouteAction();
    $action = substr($route, strpos($route, '@') + 1);
@endphp

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    @if ($action == 'edit')
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    @endif
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    @if ($action == 'edit')
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    @endif
@endsection

@if ($action == 'edit')
    {!! Form::model($outlet, ['route' => ['admin.outlet.update', $outlet], 'method' => 'put', 'files' => true]) !!}
@else
    {!! Form::open(['route' => 'admin.outlet.store', 'method' => 'post', 'files' => true, 'id' => 'outlet-form']) !!}
@endif

<div class="row">
    {{ Form::hidden('merchant_id', 
        $merchant->id ?? $outlet->merchant_id, [
            'class'         => 'form-control', 
            'required'      => true, 
            'autocomplete'  => 'off'
        ]
    ) }}
    <div class="col-md-12 col-lg-12">
        <div class="form-group">
            <label for="name">Name</label>
            {{ Form::text('name', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => true, 
                    'autocomplete'  => 'off'
                ]
            ) }}
        </div>
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="name">Email</label>
            {{ Form::email('email', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off',
                    'id'            => 'val-email'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="name">Phone</label>
            {{ Form::text('phone', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="form-group">
            <label for="description">Description</label>
            {{ Form::textarea('description', 
                null, [
                    'class'             => 'js-maxlength form-control', 
                    'required'          => false, 
                    'autocomplete'      => 'off', 
                    'rows'              => 4, 
                    'maxlength'         => 255, 
                    'data-always-show'  => 'true', 
                    'data-placement'    => 'top'
                ]
            ) }}
            <small class="form-text text-muted">
                255 Character Max
            </small>
        </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="form-group">
            <label for="industry">Services</label>
            {{ Form::select('service_codes[]', 
                $services, 
                $selected ?? null, [
                    'class'             => 'js-select2 form-control', 
                    'required'          => false, 
                    'autocomplete'      => 'off', 
                    'data-placeholder'  => 'Choose multiple..',
                    'style'             => 'width: 100%;',
                    'multiple'          => true,
                    'id'                => 'services'
                ]
            ) }}
            <div class="custom-control custom-checkbox custom-control-lg mt-2">
                {{ Form::checkbox('checkall', 
                    1, 
                    null, [
                        'class' => 'custom-control-input', 
                        'id' => 'checkall'
                    ]
                ); }}
                <label class="custom-control-label" for="checkall">All Services</label>
            </div>
        </div>
    </div>
    @if ($action == 'edit')
    <div class="col-md-12 col-lg-12">
        <div class="form-group">
            <label for="name">Address</label>
            {{ Form::text('address', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="form-group">
            <label for="name">Address 2</label>
            {{ Form::text('address2', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="form-group">
            <label for="name">Postcode</label>
            {{ Form::text('postcode', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off',
                    'id'            => 'postcode'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="form-group">
            <label for="name">State</label>
            {{ Form::text('state', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off',
                    'id'            => 'state'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="form-group">
            <label for="country">Country</label>
            {{ Form::text('country', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off',
                    'id'            => 'country'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group" style="width: 100%; height: 400px" id="map"></div>
        <div class="form-group">
            <button class="btn btn-alt-secondary" id="getlocation">Get Current Location</button>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="name">Latitude</label>
                    {{ Form::text('latitude', 
                        null, [
                            'class'         => 'form-control', 
                            'required'      => false, 
                            'autocomplete'  => 'off',
                            'id'            => 'latitude'
                        ]
                    ) }}
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="form-group">
                    <label for="name">Longitude</label>
                    {{ Form::text('longitude', 
                        null, [
                            'class'         => 'form-control', 
                            'required'      => false, 
                            'autocomplete'  => 'off',
                            'id'            => 'longitude'
                        ]
                    ) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="name">Search By Address</label>
            <div class="input-group">
                {{ Form::text('search', 
                    null, [
                        'class'         => 'form-control', 
                        'required'      => false, 
                        'autocomplete'  => 'off',
                        'id'            => 'search'
                    ]
                ) }}
                <div class="input-group-append">
                    <button class="btn btn-alt-secondary" id="searchBtn">Search</button>
                </div>
            </div>
        </div>
        <div class="block" id="searchResults" style="height: 300px; overflow-y: scroll;"></div>
    </div>
    @endif
    <div class="col-md-12 col-lg-12">
        <div class="form-group">
            <label for="description">Email Body</label>
            {{ Form::textarea('email_body', 
                null, [
                    'class'             => 'js-maxlength form-control', 
                    'required'          => true, 
                    'autocomplete'      => 'off', 
                    'rows'              => 4, 
                    'maxlength'         => 255, 
                    'data-always-show'  => 'true', 
                    'data-placement'    => 'top'
                ]
            ) }}
            <small class="form-text text-muted">
                255 Character Max
            </small>
        </div>
        <div class="form-group">
            <label for="name">Email Footer</label>
            {{ Form::text('email_footer', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => true, 
                    'autocomplete'  => 'off'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label>Publish</label>
            <div class="custom-control custom-switch mb-1">
                {{ Form::checkbox('is_publish', 
                    1, 
                    null, [
                        'class' => 'custom-control-input', 
                        'id' => 'is_publish'
                    ]
                ); }}
                <label class="custom-control-label" for="is_publish"></label>
            </div>
        </div>
    </div>
</div>
<x-forms.button/>

@push('scripts')
@if ($action == 'edit')
<script>
jQuery('#getlocation').on('click', function(e){
    e.preventDefault();
    getLocation();
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var lat = position.coords.latitude.toFixed(6);
    var lng = position.coords.longitude.toFixed(6);

    jQuery('#latitude').val(lat);
    jQuery('#longitude').val(lng);

    map.removeObjects(map.getObjects());
    addMarkersToMap(map, lat, lng);
    map.setCenter({lat:lat, lng:lng});
}

var latitude = {{ $outlet->latitude ?? 0 }};
var longitude = {{ $outlet->longitude ?? 0 }};

//var icon = new H.map.Icon('{{ asset('/images/marker.png') }}');

function addMarkersToMap(map, lat = latitude, lng = longitude) {
    var marker = new H.map.Marker({lat: lat, lng: lng}, {
        volatility: true
    });
    
    marker.draggable = true;
    map.addObject(marker);

    // disable the default draggability of the underlying map
    // and calculate the offset between mouse and target's position
    // when starting to drag a marker object:
    marker.addEventListener('dragstart', function(ev) {
        var target = ev.target,
        pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
            var targetPosition = map.geoToScreen(target.getGeometry());
            target['offset'] = new H.math.Point(pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y);
            behavior.disable();
        }
    }, false);


    // re-enable the default draggability of the underlying map
    // when dragging has completed
    marker.addEventListener('dragend', function(ev) {
        var target = ev.target;
        if (target instanceof H.map.Marker) {
            behavior.enable();
        }

        jQuery('#latitude').val(marker.getGeometry().lat.toFixed(6));
        jQuery('#longitude').val(marker.getGeometry().lng.toFixed(6));
        //console.log(marker.getGeometry().lat.toFixed(6)+', '+marker.getGeometry().lng.toFixed(6));
    }, false);

    // Listen to the drag event and move the position of the marker
    // as necessary
    marker.addEventListener('drag', function(ev) {
        var target = ev.target,
        pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
            target.setGeometry(map.screenToGeo(pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y));
        }
    }, false);
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

jQuery('#searchBtn').on('click', function(e){
    e.preventDefault();
    One.block('state_toggle', '#searchResults');
    jQuery('.search-results').remove();
    var service = platform.getSearchService();
    var address = jQuery('#search').val();
    service.geocode({
        q: address
    }, (result) => {
        // Add a marker for each location found
        var results = '';
        var listing = '';

        result.items.forEach((item) => {
        //listing += '<div class="block block-bordered search-results"><div class="p-3">'+item.address.label+'</div></div>';
            results = document.createElement('div');
            results.innerHTML += '<div class="block block-bordered search-results"><div class="p-3">'+item.address.label+'</div></div>';
            results.addEventListener('click', function(){
                getSearchLocation(item);
            }, false);
            jQuery('#searchResults').append(results);
        });
        One.block('state_toggle', '#searchResults');
    }, alert);
});

function getSearchLocation(location) {
    console.log(location);
    map.removeObjects(map.getObjects());
    addMarkersToMap(map, location.position.lat, location.position.lng);

    jQuery('#latitude').val(location.position.lat.toFixed(6));
    jQuery('#longitude').val(location.position.lng.toFixed(6));
    jQuery('#postcode').val(location.address.postalCode);
    jQuery('#state').val(location.address.state);
    jQuery('#country').val(location.address.countryName);

    map.setCenter(location.position);
}

// Now use the map as required...
addMarkersToMap(map);
</script>
@endif
<script>
jQuery('#services').on('change', function(){
    var options = jQuery('#services option').length;
    var selected = jQuery(this).select2('data').length;
    if (options === selected) {
        jQuery("#checkall").prop('checked', true);
    } else {
        jQuery("#checkall").prop('checked', false);
    }
});

jQuery("#checkall").click(function(){
    if(jQuery(this).is(':checked')){
        jQuery("#services > option").attr("selected", "selected");
        jQuery("#services").trigger("change");
        //jQuery('#services').select2({disabled:'readonly'});
    } else {
        jQuery("#services > option").removeAttr("selected");
        jQuery("#services").trigger("change");
        //jQuery('#services').select2({disabled:false});
    }
});
</script>
@endpush