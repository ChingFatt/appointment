@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@php
    $route = Route::currentRouteAction();
    $action = substr($route, strpos($route, '@') + 1);
@endphp

@if ($action == 'edit')
    {!! Form::model($merchant, ['route' => ['admin.merchant.update', $merchant], 'method' => 'put', 'files' => true]) !!}
@else
    {!! Form::open(['route' => 'admin.merchant.store', 'method' => 'post', 'files' => true, 'class' => 'js-validation']) !!}
@endif

<div class="row justify-content-center">
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
        <div class="form-group">
            <label for="industry">Industry</label>
            {{ Form::select('industry_id', 
                $industries, 
                null, [
                    'class'             => 'js-select2 form-control', 
                    'required'          => true, 
                    'autocomplete'      => 'off', 
                    'data-placeholder'  => 'Choose one..',
                    'placeholder'       => '',
                    'style'             => 'width: 100%;'
                ]
            ) }}
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            {{ Form::textarea('description', 
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