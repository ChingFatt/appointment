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
    {!! Form::open(['route' => 'admin.merchant.store', 'method' => 'post', 'files' => true]) !!}
@endif

@yield('form')
<div class="row">
    <div class="col-md-12 col-lg-4">
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
    <div class="col-md-12 col-lg-4">
        <div class="form-group">
            <label for="email">Email</label>
            {{ Form::email('email', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => true, 
                    'autocomplete'  => 'off'
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="form-group">
            <label for="password">Password Generator</label>
            {{ Form::text('password', 
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
            <label for="role">Role</label>
            {{ Form::select('role_id', 
                $roles, 
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
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="merchant">Merchant</label>
            {{ Form::select('merchant_id', 
                $merchants, 
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
    </div>
    <div class="col-md-12 col-lg-12">
        @php
            $route = Route::currentRouteAction();
            $action = substr($route, strpos($route, '@') + 1);
        @endphp
        @if ($action == 'create' || $action == 'edit')
        <div class="form-group">
            {!! Form::btnSave() !!}
            {{ Form::close() }}
        </div>
        @endif
    </div>
</div>