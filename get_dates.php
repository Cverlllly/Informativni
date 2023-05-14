<?php
include 'header.php';

// Retrieve all the dates from the "termini" table
$sql = "SELECT datum FROM termini";
$result = $conn->query($sql);

// Create an array of events to be displayed in the calendar
$events = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $event = array(
      'title' => 'Reserved',
      'start' => $row['datum'],
      'color' => 'red'
    );
    array_push($events, $event);
  }
}

// Output the events as a JSON array
echo json_encode($events);

$conn->close();
?>