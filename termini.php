<?php require_once 'navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link href='termini.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script>
        $(document).ready(function() {
            // Retrieve the events from the PHP script
            $.ajax({
                url: 'get_events.php',
                dataType: 'json',
                success: function(events) {
                    // Check that the events array is valid
                    if (!Array.isArray(events)) {
                        console.error('Invalid events array:', events);
                        return;
                    }
                    for (var i = 0; i < events.length; i++) {
                        var event = events[i];
                        if (!event.id || !event.title || !event.start || !event.end) {
                            console.error('Invalid event object:', event);
                            return;
                        }
                    }
                    // Initialize the calendar
                    $('#calendar').fullCalendar({
                        events: events
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error retrieving events:', error);
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div id='calendar'></div>
    </div>
</body>
</html>