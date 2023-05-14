<?php require_once 'header.php';

$date = $_GET['date'];

$sql = "SELECT * FROM prijava WHERE datum_obiska LIKE '$date %'";
$result = mysqli_query($conn, $sql);

$events = array();

while ($row = mysqli_fetch_assoc($result)) {
    $event = array(
        'ime_sole' => $row['ime_sole'],
        'datum_obiska' => $row['datum_obiska'],
        'st_ucencev' => $row['st_ucencev'],
        'sredstva' => $row['sredstva'],
        'urnik_obiska' => $row['urnik_obiska']
    );

    array_push($events, $event);
}

// Return events as JSON object
header('Content-Type: application/json');
echo json_encode($events);

// Close database connection
mysqli_close($conn);

?>