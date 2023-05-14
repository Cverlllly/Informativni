<?php require_once 'header.php';

// Retrieve the events from the database
$result = $conn->query("SELECT * FROM prijava");

// Format the events as JSON
$events = array();
while ($row = $result->fetch_assoc()) {
    $event = array(
        'id' => $row['prijava_id'],
        'title' => $row['ime_sole'],
        'start' => $row['datum_obiska'],
        'end' => $row['sredstva'],
        // Add any other relevant information here
    );
    array_push($events, $event);
}
echo json_encode($events);
$conn->close();
?>
