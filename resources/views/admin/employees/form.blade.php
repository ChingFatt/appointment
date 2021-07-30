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
                    'multiple'          => true
                ]
            ) }}
        </div>
    </div>
</div>
@if ($action == 'create' || $action == 'edit')
<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            {!! Form::btnSave() !!}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endif