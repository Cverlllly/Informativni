<?php require_once 'navbar.php';

?>
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
                        $('#data-container').append("<p><b>Ime šole:</b><br>" + value.ime_sole + "</p><br> ");
                        $('#data-container').append("<p><b>Datum obiska:</b><br> " + value.datum_obiska + "</p><br>");
                        $('#data-container').append("<p><b>Št učencev:</b> <br>" + value.st_ucencev + "</p><br>");
                        $('#data-container').append("<p><b>Sredstva:</b> <br>" + value.sredstva + "</p><br>");
                        $('#data-container').append("<p><b>Urnik obiska:</b> <br>" + value.urnik_obiska + "</p><br>");
                        $('#data-container').append("<p><b>Obisk šole:</b> <br>" + value.ime_obisk + "</p>");
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error retrieving data:', error);
                    console.log(date.format());
                }
                
            });
            
        },
        eventAfterRender: function(event, element, view) {
            var eventDate = moment(event.start).format('YYYY-MM-DD');
            var cell = $('td[data-date="' + eventDate + '"]');
            cell.addClass('has-events');
        }
    });
});
    </script>
    <style>
        .has-events {
            background-color: #e8f1fe;
        }
    </style>
</head>
<body>
<div class="test">
<div class="container">
    <div class="calendar-container">
            <div id="calendar"></div>
        </div>
        <div class="data-container">
            <div id="data-container"></div>
        </div>
    </div>
</div>
</body>
</html>
