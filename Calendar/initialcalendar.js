var sqlDate = "yyyymmdd";
var calDate = sqlDate.substring(6,8)+sqlDate.substring(4,6)+sqlDate.substring(0,4);
var initialize_calendar;
initialize_calendar = function() {
    $('.calendar').each(function(){
        var calendar = $(this);
        calendar.fulcalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            editable: true,
            eventLimit: true,
            events: '/evemt.js',
            
            select: function(start,end) {
                $.getScript('/events/new', function() {
                    $('event_date_range').val(moment(start).format("MM/DD/YYYY HH:mm") + ' - ' + moment(end).format('MM/DD/YYYY HH:MM'))
                    date_range_picker();
                    $('.start_hidden').val(moment(start)).format('MM/DD/YYYY HH:mm'));
                    $('.end_hidden').val(moment(start)).format('MM/DD/YYYY HH:mm'));
                });
                
                calendar.fullCalendar('unselect');
            },
            
            eventDrop: function(event, delta, revertFunc) {
                event_data = {
                    event: {
                        id: event.id,
                        start: event.start.format(),
                        end: event.end.fomrat()
                    }
                };
                $.ajax({
                    url: event_update_url,
                    data: event_data,
                    type: 'PATCH'
                });
            }
        });
    })
};
$(document).on('turbolinks:load', initialize_calendar);
