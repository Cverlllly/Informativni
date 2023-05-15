<?php include 'navbar.php'?>
<head>
  <title>My Calendar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  <link rel="stylesheet" href="st.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.7/index.global.min.js" integrity="sha512-ImaVFNPyY+SQqhqxDOvh1woqWerGOjHQwCbbMa/U06wxb2Yq+nCpxJraA1Iv9MQiqBzN+e3w8CwI/l71mjMIJg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <div id="calendar"></div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        dateClick: function(info) {
          var selectedDate = moment(info.date).format('YYYY-MM-DD');

          // Check if the selected date already exists in the database
          var xhr = new XMLHttpRequest();
          xhr.open('GET', 'check_date.php?date=' + selectedDate);
          console.log();
          xhr.onload = function() {
            if (xhr.status === 200) {
              var response = JSON.parse(xhr.responseText);
              if (response.exists) {
                // If the date exists, send a DELETE request to the 'ter.php' file to delete it
                var xhr2 = new XMLHttpRequest();
                xhr2.open('DELETE', 'ter.php?date=' + selectedDate);
                xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr2.onload = function() {
                  if (xhr2.status === 200) {
                    calendar.refetchEvents();
                  }
                };
                xhr2.send('date=' + selectedDate);
              } else {
                // If the date does not exist, send a POST request to the 'ter.php' file to reserve it
                var xhr3 = new XMLHttpRequest();
                xhr3.open('POST', 'ter.php');
                xhr3.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr3.onload = function() {
                  if (xhr3.status === 200) {
                    calendar.refetchEvents();
                  }
                };
                xhr3.send('date=' + selectedDate);
              }
            }
          };
          xhr.send();
        },
        events: 'get_dates.php'
      });
      calendar.render();
    });
  </script>
</body>
</html>
