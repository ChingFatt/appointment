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
    {!! Form::model($appointment, ['route' => ['admin.appointment.update', $appointment], 'method' => 'put', 'files' => true]) !!}
@else
    {!! Form::open(['route' => 'admin.appointment.store', 'method' => 'post', 'files' => true, 'class' => 'js-validation']) !!}
@endif

<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <div class="form-group">
            <label for="status">Status</label>
            {{ Form::select('status', [
                    'Cancelled' => 'Cancelled',
                    'Scheduled' => 'Scheduled',
                    'Pending' => 'Pending'
                ],
                null, [
                    'class'         => 'form-control', 
                    'required'      => true, 
                    'autocomplete'  => 'off',
                    'placeholder'   => '- Please Select -'
                ]
            ) }}
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12 col-lg-12">
        <p class="alert alert-info font-size-sm">
            <i class="fa fa-fw fa-info mr-1"></i> This remarks will not be displayed to the customer.
        </p>
        <div class="form-group">
            <label for="one-ecom-customer-note">Remarks</label>
            {{ Form::textarea('remarks', 
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
</div>
<x-forms.button/>