<?php include 'navbar.php' ?>
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
          // Get the selected date
          var selectedDate = moment(info.date).format('YYYY-MM-DD');

          // Send an AJAX request to insert the selected date into the "termini" table
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'ter.php');
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
            if (xhr.status === 200) {
              calendar.refetchEvents();
            }
          };
          xhr.send('date=' + selectedDate);
        },
        events: 'get_dates.php'
      });
      calendar.render();
    });
  </script>
</body>
</html>
