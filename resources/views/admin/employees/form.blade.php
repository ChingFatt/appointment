@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@sectionMissing('form')
    {!! Form::open(['route' => 'admin.employee.store', 'method' => 'post', 'files' => true]) !!}
@endif

@php
    $route = Route::currentRouteAction();
    $action = substr($route, strpos($route, '@') + 1);
@endphp

@yield('form')
<div class="row justify-content-center">
    {{ Form::hidden('outlet_id', 
        $outlet->id ?? $employee->outlet_id, [
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
</div>
<x-forms.button/>

@push('scripts')
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
    } else {
        jQuery("#services > option").removeAttr("selected");
        jQuery("#services").trigger("change");
    }
});
</script>
@endpush