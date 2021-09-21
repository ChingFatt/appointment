@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Page JS Plugins -->
    <script src="{{ asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/datepair.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.datepair.min.js') }}"></script>
@endsection

@php
    $route = Route::currentRouteAction();
    $action = substr($route, strpos($route, '@') + 1);
@endphp

@if ($action == 'edit')
    {!! Form::model($operatingHour, ['route' => ['admin.operating_hour.update', $operatingHour], 'method' => 'put', 'files' => true]) !!}
@else
    {!! Form::open(['route' => ['admin.outlet.operating_hour.store', $outlet], 'method' => 'post', 'files' => true]) !!}
@endif

<div class="block block-rounded">
    <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#operating-hour">Operating Hours</a>
        </li>
        @php
            $route = Route::currentRouteAction();
            $action = substr($route, strpos($route, '@') + 1);
        @endphp
        @if ($action == 'edit')
        <li class="nav-item">
            <a class="nav-link" href="#public-holiday">Public Holidays</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#other-holiday">Other Holidays</a>
        </li>
        @endif
        {{-- <li class="nav-item ml-auto">
            <div class="block-options pl-3 pr-2">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
            </div>
        </li> --}}
    </ul>
    <div class="block-content tab-content">
        <div class="tab-pane active" id="operating-hour" role="tabpanel">
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
                <div class="col-md-12 col-lg-4">
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
                <div class="col-md-12 col-lg-4">
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
                <div class="col-md-12 col-lg-4">
                    <label for="rest_time">Rest Time 2</label>
                    <div class="form-group">
                        <div class="input-group datepair rest-time">
                            {{ Form::text('operating_hours['.$day.'][rest_start_time2]', 
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
                            {{ Form::text('operating_hours['.$day.'][rest_end_time2]', 
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
            </div>
        </div>
        @if ($action == 'edit')
        <div class="tab-pane" id="public-holiday" role="tabpanel">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="form-group">
                        <label for="country">Country</label>
                        {{ Form::select('country', 
                            $countries, 
                            null, [
                                'class'             => 'js-select2 form-control', 
                                'required'          => false, 
                                'autocomplete'      => 'off', 
                                'data-placeholder'  => 'Choose one..',
                                'placeholder'       => '- Please Select -',
                                'style'             => 'width: 100%;',
                                'id'                => 'country'
                            ]
                        ) }}
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="form-group">
                        <label for="year">Year</label>
                        {{ Form::select('year', 
                            $years, 
                            null, [
                                'class'             => 'js-select2 form-control', 
                                'required'          => false, 
                                'autocomplete'      => 'off', 
                                'data-placeholder'  => 'Choose one..',
                                'placeholder'       => '- Please Select -',
                                'style'             => 'width: 100%;',
                                'id'                => 'year'
                            ]
                        ) }}
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="form-group">
                        <label>Search</label>
                        <div>
                            <button class="btn btn-alt-secondary" id="searchBtn">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    Number of records: <strong id="results">0</strong>
                    <table class="table table-bordered table-striped table-hover" id="result-table">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input" id="checkall" name="checkall">
                                        <label class="custom-control-label" for="checkall"></label>
                                    </div>
                                </th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Close on this day</th>
                                <th>Close on eve</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($public_holidays)
                            @foreach ($public_holidays as $date => $holiday)
                            <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" checked class="custom-control-input checkholiday" onclick="isCheckedbox(event, this)" id="public_holidays{{ $date }}" name="public_holidays[{{ $date }}]{{ $date }}">
                                        <label class="custom-control-label" for="public_holidays{{ $date }}"></label>
                                    </div>
                                </td>
                                <td>{{ $date }}</td>
                                <td>
                                    <input type="checkbox" checked class="d-none holidayclose" name="public_holidays[{{ $date }}][name]" value="{{ $holiday['name'] }}">{{ $holiday['name'] }}
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input holidayclose" id="public_holidays[{{ $date }}][ph]" name="public_holidays[{{ $date }}][ph]" value="1" {{ ($holiday['ph']) ? 'checked' : ''; }}>
                                        <label class="custom-control-label" for="public_holidays[{{ $date }}][ph]"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input holidayclose" id="public_holidays[{{ $date }}][eve]" name="public_holidays[{{ $date }}][eve]" value="1" {{ ($holiday['eve']) ? 'checked' : ''; }}>
                                        <label class="custom-control-label" for="public_holidays[{{ $date }}][eve]"></label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                        <tbody id="result">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="other-holiday" role="tabpanel">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <table class="table table-bordered table-striped table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Close on this day</th>
                                <th>Close on eve</th>
                                <th><a href="javascript:void(0);" class="btn btn-sm btn-alt-success js-tooltip-enabled add_button" title="Add"><i class="fa fa-fw fa-plus"></i></a></th>
                            </tr>
                        </thead>
                        <tbody class="field_wrapper">
                            @isset($operatingHour->other_holidays)
                            @foreach ($operatingHour->other_holidays as $date => $other_holiday)
                            <tr>
                                <td>
                                    <input type="text" name="other_holidays[{{ $loop->iteration }}][date]" class="form-control datepicker" onclick="datepicker(this)" value="{{ $date ?? '' }}" placeholder="yyyy-mm-dd"/>
                                </td>
                                <td>
                                    <input type="text" name="other_holidays[{{ $loop->iteration }}][name]" class="form-control" value="{{ $other_holiday['name'] ?? '' }}" placeholder="Holiday Name"/>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input holidayclose" id="other_holidays[{{ $loop->iteration }}][ph]" name="other_holidays[{{ $loop->iteration }}][ph]" value="1" {{ ($other_holiday['ph']) ? 'checked' : ''; }}>
                                        <label class="custom-control-label" for="other_holidays[{{ $loop->iteration }}][ph]"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox d-inline-block">
                                        <input type="checkbox" class="custom-control-input holidayclose" id="other_holidays[{{ $loop->iteration }}][eve]" name="other_holidays[{{ $loop->iteration }}][eve]" value="1" {{ ($other_holiday['eve']) ? 'checked' : ''; }}>
                                        <label class="custom-control-label" for="other_holidays[{{ $loop->iteration }}][eve]"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-alt-danger js-tooltip-enabled remove_button" title="Add">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="block-content">
        <x-forms.button/>
    </div>
</div>

@push('scripts')
<script>
jQuery('.datepair.operating-hour').datepair({
    defaultTimeDelta: 8 * 60 * 60 * 1000,
});
jQuery('.datepair.rest-time').datepair({
    defaultTimeDelta: 1 * 60 * 60 * 1000,
});

jQuery('#searchBtn').on('click', function(e){
    e.preventDefault();
    var country = jQuery('#country').val();
    var year = jQuery('#year').val();
    var holidays = jQuery.get('https://calendarific.com/api/v2/holidays?&api_key=a82664be48e31697f59ce9bd56e6b14a4cc0607d&country='+country+'&year='+year, function(data, status){

            jQuery('#results').html(data.response.holidays.length);
            jQuery("#checkall").prop('checked', false);
            jQuery('#result').html('');
            var x = 1;
            var result;

            data.response.holidays.forEach((item) => {
                result = '<tr>';
                result += '<td class="text-center"><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" class="custom-control-input checkholiday" onclick="isCheckedbox(event, this)" id="public_holidays'+x+'" name="public_holidays['+item.date.iso+']'+x+'"><label class="custom-control-label" for="public_holidays'+x+'"></label></div></td>';
                result += '<td>'+item.date.iso+'</td>';
                result += '<td><input type="checkbox" class="d-none holidayclose" name="public_holidays['+item.date.iso+'][name]" value="'+item.name+'">'+item.name+'</td>';
                result += '<td><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" class="custom-control-input holidayclose" id="public_holidays['+item.date.iso+'][ph]" name="public_holidays['+item.date.iso+'][ph]" value="1"><label class="custom-control-label" for="public_holidays['+item.date.iso+'][ph]"></label></div></td>';
                result += '<td><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" class="custom-control-input holidayclose" id="public_holidays['+item.date.iso+'][eve]" name="public_holidays['+item.date.iso+'][eve]" value="1"><label class="custom-control-label" for="public_holidays['+item.date.iso+'][eve]"></label></div></td>';
                result += '</tr>';
                jQuery('#result').append(result);
                x = x+1;
            });
            jQuery('#result').find('.holidayclose').prop('disabled', true);
    });
});

jQuery("#checkall").prop('checked', false);

jQuery("#checkall").click(function(){
    if (jQuery(this).is(':checked')){
        jQuery('.checkholiday').not(this).prop('checked', this.checked)
        jQuery('.holidayclose').prop('disabled', false);
        jQuery('.holidayclose').prop('checked', true);
    } else {
        jQuery('.checkholiday').prop('checked', false)
        jQuery('.holidayclose').prop('disabled', true);
        jQuery('.holidayclose').prop('checked', false);
    }

    jQuery(".checkholiday").each(function(){
        jQuery('.checkholiday').on('change', function(){
            var total = jQuery('.checkholiday').length;
            var totalChecked = jQuery('.checkholiday:checked').length;
            
            if (total === totalChecked) {
                jQuery("#checkall").prop('checked', true)
            } else {
                jQuery("#checkall").prop('checked', false)
            }

        });
    })
});

function isCheckedbox(e, input){
    if (jQuery(input).prop('checked') == true) {
        jQuery(input).closest('tr').find('.holidayclose').prop('disabled', false);
        jQuery(input).closest('tr').find('.holidayclose').prop('checked', true);
    } else {
        jQuery(input).closest('tr').find('.holidayclose').prop('disabled', true);
        jQuery(input).closest('tr').find('.holidayclose').prop('checked', false);
    }
}
</script>
@if ($action == 'edit')
<script>
jQuery(document).ready(function(){
    var maxField = 10; 
    var addButton = jQuery('.add_button');
    var wrapper = jQuery('.field_wrapper');                                        
    var x = {{ (isset($operatingHour->other_holidays)) ? count($operatingHour->other_holidays) + 1 : 1}};
    
    jQuery(addButton).click(function(){
        var fieldHTML   = '<tr>';
        fieldHTML       += '<td><input type="text" name="other_holidays['+x+'][date]" class="form-control datepicker" onclick="datepicker(this)" value="" placeholder="yyyy-mm-dd"/></td>';
        fieldHTML       += '<td><input type="text" name="other_holidays['+x+'][name]" class="form-control" value="" placeholder="Holiday Name"/></td>';
        fieldHTML       += '<td><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" class="custom-control-input holidayclose" id="other_holidays['+x+'][ph]" name="other_holidays['+x+'][ph]" value="1"><label class="custom-control-label" for="other_holidays['+x+'][ph]"></label></div></td>';
        fieldHTML       += '<td><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" class="custom-control-input holidayclose" id="other_holidays['+x+'][eve]" name="other_holidays['+x+'][eve]" value="1"><label class="custom-control-label" for="other_holidays['+x+'][eve]"></label></div></td>';
        fieldHTML       += '<td><a href="javascript:void(0);" class="btn btn-sm btn-alt-danger js-tooltip-enabled remove_button" title="Remove"><i class="fa fa-fw fa-trash"></i></a></td>';
        fieldHTML       += '</tr>';

        jQuery(wrapper).append(fieldHTML);
        x++;
    });
    
    jQuery(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        jQuery(this).closest('tr').remove();
        //x--;
    });
});

function datepicker(input){
    jQuery(input).datepicker({
        startDate: '+1d',
        format: 'yyyy-mm-dd',
        todayHighlight: false,
        enableOnReadonly: false,
        autoclose: true,
        multidate: false
    }).on('changeDate', function(e) {
        //
    });
    jQuery(input).datepicker('show');
}
</script>
@endif
@endpush