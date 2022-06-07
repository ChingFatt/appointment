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
    {!! Form::model($emailConfig, ['route' => ['admin.email_config.update', $emailConfig], 'method' => 'put', 'files' => true]) !!}
@else
    {!! Form::open(['route' => ['admin.outlet.email_config.store', $outlet], 'method' => 'post', 'files' => true]) !!}
@endif

<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        {{ Form::hidden('outlet_id', 
            $outlet->id ?? $emailConfig->outlet_id, [
                'class'         => 'form-control', 
                'required'      => true, 
                'autocomplete'  => 'off'
            ]
        ) }}
        <div class="form-group">
            <label for="status">Status</label>
            <x-input.select2 name="status" :options="App\Models\Appointment::STATUSES"/>
        </div>
        <div class="form-group">
            <label for="header">Header</label>
            <x-input.textarea name="header"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <x-input.textarea name="body"/>
        </div>
        <div class="form-group">
            <label for="footer">Footer</label>
            <x-input.textarea name="footer"/>
        </div>
        <div class="form-group">
            <label>Signature </label> <small class="text-muted">eg: 1600 x 1200 ( 4:3 ratio ), less than 500KB</small>
            @isset ($emailConfig->signature)
            <div class="card card-body text-center">
                <img src="{{ $emailConfig->signature }}" class="d-block w-50 mx-auto">
                <a href="{{ $emailConfig->signature }}" target="_blank">{{ $emailConfig->signature }}</a>
            </div>
            @endisset
            {{ Form::file('file', ['class' => 'd-block', 'accept' => 'image/png, image/jpeg']) }}
        </div>
    </div>
</div>
<x-forms.button/>