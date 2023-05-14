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
    // Initialize the calendar
    $('#calendar').fullCalendar({
        events: 'get_events.php',
        dayClick: function(date, jsEvent, view) {
            $.ajax({
                url: 'get_data.php',
                data: {
                    date: date.format()
                },
                success: function(response) {
                    console.log(response);
                    $('#data-container').empty();
                    $.each(response, function(key, value) {
                        $('#data-container').append("<p>Ime šole: " + value.ime_sole + "</p>");
                        $('#data-container').append("<p>Datum obiska: " + value.datum_obiska + "</p>");
                        $('#data-container').append("<p>Št učencev: " + value.st_ucencev + "</p>");
                        $('#data-container').append("<p>Sredstva: " + value.sredstva + "</p>");
                        $('#data-container').append("<p>Urnik obiska: " + value.urnik_obiska + "</p>");
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error retrieving data:', error);
                    console.log(date.format());
                }
                
            });
        }
    });
});
    </script>
</head>
<body>
<div class="container">
    <div class="calendar-container">
        <div id="calendar"></div>
    </div>
    <div class="data-container">
        <div id="data-container"></div>
    </div>
</div>
</body>
</html>