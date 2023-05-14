<?php require_once 'header.php';
$_COOKIE['admin'];
$admin = json_decode($_COOKIE['admin'], true);
$id = $admin['ime'];
$date = $_GET['date'];

$sql = "SELECT * FROM prijava p inner join termini t on t.termini_id= p.termin_id inner join sole s on s.sola_id=p.sola_id WHERE t.datum = '$date'";
$result = mysqli_query($conn, $sql);

$events = array();

while ($row = mysqli_fetch_assoc($result)) {
    $event = array(
        'ime_sole' => $row['ime_sole'],
        'datum_obiska' => $row['datum'],
        'st_ucencev' => $row['st_ucencev'],
        'sredstva' => $row['sredstva'],
        'urnik_obiska' => $row['urnik_obiska'],
        'ime_obisk' => $row['ime_obisk'],

    );

    array_push($events, $event);
}

// Return events as JSON object
header('Content-Type: application/json');
echo json_encode($events);

// Close database connection
mysqli_close($conn);

?>