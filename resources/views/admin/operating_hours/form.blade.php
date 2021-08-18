@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/datepair.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.datepair.min.js') }}"></script>
@endsection

@sectionMissing('form')
    {!! Form::open(['route' => 'admin.operating_hour.store', 'method' => 'post', 'files' => true]) !!}
@endif

@yield('form')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="alert alert-info" role="alert">
            <h3 class="alert-heading h4 my-2">Information</h3>
            <p class="mb-0">Please leave empty if not applicable.</p>
        </div>
    </div>
    {{ Form::hidden('outlet_id', 
        $outlet->id ?? $operatingHour->outlet_id, [
            'class'         => 'form-control', 
            'required'      => true, 
            'autocomplete'  => 'off'
        ]
    ) }}
    @php
        $week = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    @endphp
    @foreach ($week as $day)
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="{{ $day }}">{{ $day }}</label>
            <div class="form-group">
                <div class="input-group datepair operating-hour">
                    {{ Form::text('operating_hours['.$day.'][start_time]', 
                        null, [
                            'class'         => 'time start form-control', 
                            'required'      => false, 
                            'autocomplete'  => 'off',
                            'placeholder'   => 'From'
                        ]
                    ) }}
                    <div class="input-group-prepend input-group-append">
                        <span class="input-group-text font-w600">
                            <i class="fa fa-fw fa-arrow-right"></i>
                        </span>
                    </div>
                    {{ Form::text('operating_hours['.$day.'][end_time]', 
                        null, [
                            'class'         => 'time end form-control', 
                            'required'      => false, 
                            'autocomplete'  => 'off',
                            'placeholder'   => 'To'
                        ]
                    ) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <label for="rest_time">Rest Time</label>
        <div class="form-group">
            <div class="input-group datepair rest-time">
                {{ Form::text('operating_hours['.$day.'][rest_start_time]', 
                    null, [
                        'class'         => 'time start form-control', 
                        'required'      => false, 
                        'autocomplete'  => 'off',
                        'placeholder'   => 'From'
                    ]
                ) }}
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        <i class="fa fa-fw fa-arrow-right"></i>
                    </span>
                </div>
                {{ Form::text('operating_hours['.$day.'][rest_end_time]', 
                    null, [
                        'class'         => 'time end form-control', 
                        'required'      => false, 
                        'autocomplete'  => 'off',
                        'placeholder'   => 'To'
                    ]
                ) }}
            </div>
        </div>
    </div>
    @endforeach
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="interval">Time Slot Interval</label>
            {{ Form::number('interval', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off',
                    'min'           => 5,
                    'max'           => 60,
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="capacity">Capacity per Time Slot</label>
            {{ Form::number('capacity', 
                null, [
                    'class'         => 'form-control', 
                    'required'      => false, 
                    'autocomplete'  => 'off',
                    'min'           => 0,
                ]
            ) }}
        </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="alert alert-info" role="alert">
            <h3 class="alert-heading h4 my-2">Public Holiday</h3>
            <p class="mb-0">Time slot apply to all public holidays. Please leave empty if not applicable.</p>
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="public">Public Holiday</label>
            <div class="form-group">
                <div class="input-group datepair operating-hour">
                    {{ Form::text('operating_hours[public_holiday][start_time]', 
                        null, [
                            'class'         => 'time start form-control', 
                            'required'      => false, 
                            'autocomplete'  => 'off',
                            'placeholder'   => 'From'
                        ]
                    ) }}
                    <div class="input-group-prepend input-group-append">
                        <span class="input-group-text font-w600">
                            <i class="fa fa-fw fa-arrow-right"></i>
                        </span>
                    </div>
                    {{ Form::text('operating_hours[public_holiday][end_time]', 
                        null, [
                            'class'         => 'time end form-control', 
                            'required'      => false, 
                            'autocomplete'  => 'off',
                            'placeholder'   => 'To'
                        ]
                    ) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <label for="rest_time">Rest Time</label>
        <div class="form-group">
            <div class="input-group datepair rest-time">
                {{ Form::text('operating_hours[public_holiday][rest_start_time]', 
                    null, [
                        'class'         => 'time start form-control', 
                        'required'      => false, 
                        'autocomplete'  => 'off',
                        'placeholder'   => 'From'
                    ]
                ) }}
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        <i class="fa fa-fw fa-arrow-right"></i>
                    </span>
                </div>
                {{ Form::text('operating_hours[public_holiday][rest_end_time]', 
                    null, [
                        'class'         => 'time end form-control', 
                        'required'      => false, 
                        'autocomplete'  => 'off',
                        'placeholder'   => 'To'
                    ]
                ) }}
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label for="eve">Eve Public Holiday</label>
            <div class="form-group">
                <div class="input-group datepair operating-hour">
                    {{ Form::text('operating_hours[eve_public_holiday][start_time]', 
                        null, [
                            'class'         => 'time start form-control', 
                            'required'      => false, 
                            'autocomplete'  => 'off',
                            'placeholder'   => 'From'
                        ]
                    ) }}
                    <div class="input-group-prepend input-group-append">
                        <span class="input-group-text font-w600">
                            <i class="fa fa-fw fa-arrow-right"></i>
                        </span>
                    </div>
                    {{ Form::text('operating_hours[eve_public_holiday][end_time]', 
                        null, [
                            'class'         => 'time end form-control', 
                            'required'      => false, 
                            'autocomplete'  => 'off',
                            'placeholder'   => 'To'
                        ]
                    ) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <label for="rest_time">Rest Time</label>
        <div class="form-group">
            <div class="input-group datepair rest-time">
                {{ Form::text('operating_hours[eve_public_holiday][rest_start_time]', 
                    null, [
                        'class'         => 'time start form-control', 
                        'required'      => false, 
                        'autocomplete'  => 'off',
                        'placeholder'   => 'From'
                    ]
                ) }}
                <div class="input-group-prepend input-group-append">
                    <span class="input-group-text font-w600">
                        <i class="fa fa-fw fa-arrow-right"></i>
                    </span>
                </div>
                {{ Form::text('operating_hours[eve_public_holiday][rest_end_time]', 
                    null, [
                        'class'         => 'time end form-control', 
                        'required'      => false, 
                        'autocomplete'  => 'off',
                        'placeholder'   => 'To'
                    ]
                ) }}
            </div>
        </div>
    </div>
    @php
        $route = Route::currentRouteAction();
        $action = substr($route, strpos($route, '@') + 1);
    @endphp
    @if ($action == 'create' || $action == 'edit')
        <div class="col-md-12 col-lg-12">
        <div class="form-group">
            {!! Form::btnSave() !!}
            {{ Form::close() }}
        </div>
    </div>
    @endif
</div>