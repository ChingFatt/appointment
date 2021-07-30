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
@livewireStyles
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Appointment</h3>
                </div>
                <div class="block-content block-content-full">
                    @livewire('appointment')
                </div>
            </div>
        </div>
    </div>
</div>
@livewireScripts
@endsection

@push('scripts')
<script>
// jQuery('#datepicker').hide();

// if (!is_null($selectedOutlet)) {
//     jQuery('#datepicker').show();
// }

jQuery('.js-datepicker').datepicker({
    startDate: '0d',
    todayHighlight: true,
    autoclose: true,
    datesDisabled: [
        "2021-08-01",
        "2021-08-15",
        "2021-08-31"
    ]
}).on('changeDate', function(e) {
    console.log('changed');
});

// jQuery('.js-datepicker').datepicker({
//     startDate: '0d',
//     todayHighlight: true,
//     autoclose: true,
//     multidate: true,
//     daysOfWeekDisabled: [{!! json_encode($picker['daysOfWeekDisabled'] ?? '') !!}],
//     datesDisabled: [
//         "2021-08-01",
//         "2021-08-15",
//         "2021-08-31"
//     ]
// }).on('changeDate', function(e) {
//     console.log('changed');
// });

// jQuery('.time').timepicker({
//     step: {!! $picker['interval'] ?? 30 !!},
//     minTime: '{!! $picker['start_time'] ?? '' !!}',
//     maxTime: '{!! $picker['end_time'] ?? '' !!}',
//     forceRoundTime: false,
//     disableTimeRanges: [
//         [{!! json_encode($picker['rest_start_time'] ?? '') !!}, {!! json_encode($picker['rest_end_time'] ?? '') !!}]
//     ]
// });

// jQuery('.datepair.operating-hour').datepair({
//     defaultTimeDelta: 8 * 60 * 60 * 1000,
// });
// jQuery('.datepair.rest-time').datepair({
//     defaultTimeDelta: 1 * 60 * 60 * 1000,
// });
</script>
@endpush