@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
    {!! Form::model($industry, ['route' => ['admin.industry.update', $industry], 'method' => 'put', 'files' => true]) !!}
@else
    {!! Form::open(['route' => 'admin.industry.store', 'method' => 'post', 'files' => true, 'class' => 'js-validation']) !!}
@endif

<div class="row">
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
            <label for="description">Description</label>
            <x-input.textarea name="description"/>
        </div>
    </div>
</div>
<x-forms.button/>