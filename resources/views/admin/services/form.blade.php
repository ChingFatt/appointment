@sectionMissing('form')
    {!! Form::open(['route' => 'admin.service.store', 'method' => 'post', 'files' => true]) !!}
@endif

@php
    $route = Route::currentRouteAction();
    $action = substr($route, strpos($route, '@') + 1);
@endphp

@yield('form')
<div class="row">
    {{ Form::hidden('merchant_id', 
        $merchant->id ?? $service->merchant_id, [
            'class'         => 'form-control', 
            'required'      => true, 
            'autocomplete'  => 'off'
        ]
    ) }}
    <div class="col-md-12 col-lg-6">
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
    @if ($action == 'edit')
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="name">Service Code</label>
            {{ Form::text('service_code', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => true, 
                    'autocomplete'  => 'off',
                    'readonly'      => true
                ]
            ) }}
        </div>
    </div>
    @endif
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