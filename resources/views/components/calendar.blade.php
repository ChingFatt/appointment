<div id="js-calendar"></div>

@once
@push('styles')
    <link rel="stylesheet" href="{{ asset('js/plugins/fullcalendar/main.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/plugins/fullcalendar/main.min.js') }}"></script>
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
        events: {!! $data !!},
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
@endonce