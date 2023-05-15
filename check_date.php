<?php
include 'header.php';

$date = $_GET['date'];

$sql = "SELECT COUNT(*) AS count FROM termini WHERE datum = '$date'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$count = $row['count'];

if ($count > 0) {
  $response = array('exists' => true);
} else {
  $response = array('exists' => false);
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
