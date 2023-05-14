<?php require_once 'header.php';
$_COOKIE['admin'];
$admin = json_decode($_COOKIE['admin'], true);
$id = $admin['ime'];
// Retrieve the events from the database
if ($id == 'vse') {
    $result = $conn->query("SELECT * FROM prijava inner join termini on termini.termini_id= prijava.termin_id");
} else {
    $result = $conn->query("SELECT * FROM prijava inner join termini on termini.termini_id= prijava.termin_id inner join sole s on s.sola_id=prijava.sola_id WHERE ime_obisk='$id'");
}

$events = array();
while ($row = $result->fetch_assoc()) {
    $event = array(
        'id' => $row['prijava_id'],
        'title' => $row['ime_sole'],
        'start' => $row['datum'],
        'end' => $row['sredstva'],
    );
    array_push($events, $event);
}
echo json_encode($events);
$conn->close();
?>
