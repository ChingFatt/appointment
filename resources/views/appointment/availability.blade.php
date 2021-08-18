@extends('layouts.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.timepicker.min.js') }}"></script>

    <script src="{{ asset('/js/plugins/jquery-timepicker/datepair.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery-timepicker/jquery.datepair.min.js') }}"></script>
@endsection

@section('content')
<div class="content">
	<div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Information</h3>
                </div>
                <div class="block-content block-content-full">
                	
                </div>
            </div>
        </div>
    </div>
	<div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Appointment</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
						<div class="col-md-12 col-lg-6" id="datepicker">
						    <div class="form-group">
						        <label for="date">Appointment Date</label>
						        <div class="input-group">
						            <input type="text" class="js-datepicker start form-control" id="date" name="date" data-week-start="1" data-today-highlight="true" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" autocomplete="off">
						            <div class="input-group-append">
						                <span class="input-group-text">
						                    <i class="si si-calendar"></i>
						                </span>
						            </div>
						        </div>
						    </div>
						</div>
						<div class="col-md-12 col-lg-6">
                            <div class="form-group">
                            	<label for="date">Preferred Time</label>
                                <div class="input-group">
						            <input type="text" class="time start form-control" name="date" placeholder="From" autocomplete="off">
						            <div class="input-group-append">
						                <span class="input-group-text">
						                    <i class="si si-clock"></i>
						                </span>
						            </div>
						        </div>
                            </div>
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
jQuery('.js-datepicker').datepicker({
    startDate: '0d',
    todayHighlight: true,
    autoclose: true,
    multidate: false,
    daysOfWeekDisabled: {!! json_encode($picker['daysOfWeekDisabled'] ?? '') !!},
    datesDisabled: [
    ]
}).on('changeDate', function(e) {
    console.log('changed');
});

jQuery('.time').timepicker({
    step: {!! $picker['interval'] ?? 30 !!},
    minTime: '{!! $picker['start_time'] ?? '' !!}',
    maxTime: '{!! $picker['end_time'] ?? '' !!}',
    forceRoundTime: false,
    disableTimeRanges: [
        [{!! json_encode($picker['rest_start_time'] ?? '') !!}, {!! json_encode($picker['rest_end_time'] ?? '') !!}]
    ]
});

jQuery('.datepair.operating-hour').datepair({
    defaultTimeDelta: 8 * 60 * 60 * 1000,
});
jQuery('.datepair.rest-time').datepair({
    defaultTimeDelta: 1 * 60 * 60 * 1000,
});
// jQuery('#datepicker').hide();

// if (!is_null($selectedOutlet)) {
//     jQuery('#datepicker').show();
// }

// jQuery('.js-datepicker').datepicker({
//     startDate: '0d',
//     todayHighlight: true,
//     autoclose: true,
//     datesDisabled: [
//         "2021-08-01",
//         "2021-08-15",
//         "2021-08-31"
//     ]
// }).on('changeDate', function(e) {
//     console.log('changed');
// });
</script>
@endpush