@php
    $route = Route::currentRouteAction();
    $action = substr($route, strpos($route, '@') + 1);
@endphp

@if ($action == 'edit')
    {!! Form::model($service, ['route' => ['admin.service.update', $service], 'method' => 'put', 'files' => true]) !!}
@else
    {!! Form::open(['route' => 'admin.service.store', 'method' => 'post', 'files' => true, 'id' => 'service-form']) !!}
@endif

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
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="duration">Duration <span class="text-muted small font-weight-light">(in Minutes)</span></label>
            {{ Form::number('duration', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => true, 
                    'autocomplete'  => 'off',
                    'min'           => 0
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
<x-forms.button/>