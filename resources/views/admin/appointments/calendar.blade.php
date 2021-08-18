@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/fullcalendar/main.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/fullcalendar/main.min.js') }}"></script>
@endsection

@section('content')
<!-- Page Content -->
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Calendar</h3>
        </div>
        <div class="block-content block-content-full">
            <div id="js-calendar"></div>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
<!-- END Page Content -->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('js-calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap',
        firstDay: 0,
        editable: false,
        droppable: false,
        headerToolbar: {
            left: 'title',
            right: 'prev,next today dayGridMonth,listWeek'//dayGridMonth,timeGridWeek,timeGridDay,listWeek
        },
        dayMaxEventRows: true,
        drop: function(info) {
            info.draggedEl.parentNode.remove();
        },
        events: {!! $appointments !!},
        eventClick: function(info) {
            info.jsEvent.preventDefault(); // don't let the browser navigate

            if (info.event.url) {
                window.open(info.event.url);
            }
        }
    });
    calendar.render();
});
</script>
@endpush