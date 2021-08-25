@extends('layouts.backend')

@section('form')
    {!! Form::model($operatingHour, ['route' => ['admin.operating_hour.update', $operatingHour], 'method' => 'put', 'files' => true]) !!}
@endsection

@section('content')
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Info</h3>
        </div>
        <div class="block-content">
            @include('admin.operating_hours.form')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
jQuery('.time').timepicker({
    listWidth: 1,
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
</script>
@endpush